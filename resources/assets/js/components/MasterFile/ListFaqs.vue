<template>

<div>
    <div class="col-xs-12 col-md-4 col-lg-4">
        <div class="panel">
            <div class="panel-heading">
                <h4 class="panel-title">Add FAQ's</h4>
            </div>
            <div class="panel-body">

                <form v-on:submit.prevent="createFaq" method="post">

                    <div v-bind:class="{'form-group': true, 'has-error': errors.question}">
                        <label>Question:</label>
                        <input type="text" v-model="faq.question" class="form-control">
                        <span class="help-block" v-for="error in errors.question">{{ error }}</span>
                    </div>

                    <div v-bind:class="{'form-group': true, 'has-error': errors.answer}">
                        <label>Answer:</label>
                        <input type="text" v-model="faq.answer" class="form-control">
                        <span class="help-block" v-for="error in errors.answer">{{ error }}</span>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Add New Faqs</button>
                    </div>

                </form>
            </div>
        </div><!-- panel -->
    </div> <!-- col -->

    <div class="col-xs-12 col-md-8 col-lg-8">
        <div class="panel">
            <div class="panel-heading">
                <h4 class="panel-title">Faqs List</h4>
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>Question</th>
                            <th>Answer</th>
                            <th>Action</th>
                        </tr>
                        </thead>

                        <tbody>
                        <Faqs v-for="faq in faqs" :key="faq.id"  v-bind:faq="faq"v-on:delete-faq="deleteFaq"v-on:update-faq="fetchFaqs">
                        </Faqs>
                        </tbody>
                    </table>

                    <!-- Pagination -->
                    <nav>
                        <ul class="pagination">
                            <li v-if="pagination.current_page > 1">
                                <a href="#" aria-label="Previous"
                                   @click.prevent="changePage(pagination.current_page - 1)">
                                    <span aria-hidden="true">«</span>
                                </a>
                            </li>
                            <li v-for="page in pagesNumber"
                                v-bind:class="[ page == isActived ? 'active' : '']">
                                <a href="#"
                                   @click.prevent="changePage(page)">{{ page }}</a>
                            </li>
                            <li v-if="pagination.current_page < pagination.last_page">
                                <a href="#" aria-label="Next"
                                   @click.prevent="changePage(pagination.current_page + 1)">
                                    <span aria-hidden="true">»</span>
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div><!-- table-responsive -->
            </div>
        </div><!-- panel -->
    </div>

</div>
</template>

<script>
    import Faqs from './Faqs.vue';
    export default {
        data(){
            return {
                faqs: [],
                errors: [],
                faq:{
                    question: '',
                    answer: ''
                },
                pagination: {
                    total: 0,
                    per_page: 2,
                    from: 1,
                    to: 0,
                    current_page: 1
                },
                offset: 4,
            }
        },
        components:{ Faqs },
        created(){
            this.fetchFaqs(this.pagination.current_page);
            //this.fetchFaqs();
        },
        computed: {
            isActived: function () {
                return this.pagination.current_page;
            },
            pagesNumber: function () {
                if (!this.pagination.to) {
                    return [];
                }
                var from = this.pagination.current_page - this.offset;
                if (from < 1) {
                    from = 1;
                }
                var to = from + (this.offset * 2);
                if (to >= this.pagination.last_page) {
                    to = this.pagination.last_page;
                }
                var pagesArray = [];
                while (from <= to) {
                    pagesArray.push(from);
                    from++;
                }
                return pagesArray;
            }
        },
        methods: {
            fetchFaqs: function(page){
                this.$http.get('/admin/faqs/list?page='+page).then(response => {
                    this.faqs  = response.data.faqs.faq.data;
                    this.pagination = response.data.faqs.pagination;
                    //this.faqs = response.data.faqs;
                });
            },
            createFaq(){
                this.$http.post('/admin/faqs/add', this.faq).then(response => {
                    this.changePage(this.pagination.current_page);
                    this.faq = {answer: '', question:''};
                     //this.faqs.push(response.data.faq);
                    if (this.errors) {
                        this.errors = [];
                    }
                    console.log(response.data);

                }, response => {
                    this.errors = response.data;
                });
            },
            deleteFaq(faq){
                this.$http.delete('/admin/faqs/delete/' + faq.id).then(response => {
                    this.changePage(this.pagination.current_page);
                    let index = this.faqs.indexOf(faq);
                    this.faqs.splice(index, 1);
                    console.log(response.data);
                });
            },

            changePage: function (page) {
                this.pagination.current_page = page;
                this.fetchFaqs(page);
            }
        },
        http: {
            root: '/root',
            headers: {
                'X-CSRF-Token': $('meta[name=csrf-token]').attr('content')
            }
        }
    }
</script>

<style>
    .avatar-feed{
        border-radius:50%;
    }
</style>