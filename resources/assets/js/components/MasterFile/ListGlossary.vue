<template>

    <div>
        <div class="col-xs-12 col-md-4 col-lg-4">
            <div class="panel">
                <div class="panel-heading">
                    <h4 class="panel-title">Add Glossary</h4>
                </div>
                <div class="panel-body">

                    <form v-on:submit.prevent="createGlossary" method="post">

                        <div v-bind:class="{'form-group': true, 'has-error': errors.word}">
                            <label>Word:</label>
                            <input type="text" v-model="glossary.word" class="form-control">
                            <span class="help-block" v-for="error in errors.word">{{ error }}</span>
                        </div>

                        <div v-bind:class="{'form-group': true, 'has-error': errors.definition}">
                            <label>Definition:</label>
                            <input type="text" v-model="glossary.definition" class="form-control">
                            <span class="help-block" v-for="error in errors.definition">{{ error }}</span>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Add New Glossary</button>
                        </div>

                    </form>
                </div>
            </div><!-- panel -->
        </div> <!-- col -->

        <div class="col-xs-12 col-md-8 col-lg-8">
            <div class="panel">
                <div class="panel-heading">
                    <h4 class="panel-title">Glossary List</h4>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>Word</th>
                                <th>Definition</th>
                                <th>Action</th>
                            </tr>
                            </thead>

                            <tbody>
                            <Glossary v-for="glossary in glossaries" :key="glossary.id"  v-bind:glossary="glossary"v-on:delete-glossary="deleteGlossary"v-on:update-glossary="fetchGlossary">
                            </Glossary>
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
    import Glossary from './Glossary.vue';
    export default {
        data(){
            return {
                glossaries: [],
                errors: [],
                glossary:{
                    word: '',
                    definition: ''
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
        components:{ Glossary },
        created(){
            this.fetchGlossary(this.pagination.current_page);
            //this.fetchGlossary();
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
            fetchGlossary: function(page){
                this.$http.get('/admin/glossary/list?page='+page).then(response => {
                    //this.glossaries = response.data.glossary;
                    this.glossaries  = response.data.glossary.gloss.data;
                    this.pagination = response.data.glossary.pagination;
                    console.log(this.glossaries);

                });
            },
            createGlossary(){
                this.$http.post('/admin/glossary/add', this.glossary).then(response => {
                    this.changePage(this.pagination.current_page);
                    //this.glossaries.push(response.data.glossary);
                    this.glossary = {word: '', definition:''};
                    if (this.errors) {
                        this.errors = [];
                    }
                    console.log(response.data);
                }, response => {
                    this.errors = response.data;
                });
            },
            deleteGlossary(glossary){
                this.$http.delete('/admin/glossary/delete/' + glossary.id).then(response => {
                    this.changePage(this.pagination.current_page);
                    let index = this.glossaries.indexOf(glossary);
                    this.glossaries.splice(index, 1);
                    console.log(response.data);
                });
            },

            changePage: function (page) {
                this.pagination.current_page = page;
                this.fetchGlossary(page);
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