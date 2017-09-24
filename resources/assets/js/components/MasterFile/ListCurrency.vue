<template>

    <div>
        <div class="col-xs-12 col-md-4 col-lg-4">
            <div class="panel">
                <div class="panel-heading">
                    <h4 class="panel-title">Add Currency</h4>
                </div>
                <div class="panel-body">

                    <form v-on:submit.prevent="createCurrency" method="post">

                        <div v-bind:class="{'form-group': true, 'has-error': errors.name}">
                            <label>Name:</label>
                            <input type="text" v-model="currency.name" class="form-control">
                            <span class="help-block" v-for="error in errors.name">{{ error }}</span>
                        </div>

                        <div v-bind:class="{'form-group': true, 'has-error': errors.description}">
                            <label>Description:</label>
                            <input type="text" v-model="currency.description" class="form-control">
                            <span class="help-block" v-for="error in errors.description">{{ error }}</span>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Add New Currency</button>
                        </div>

                    </form>
                </div>
            </div><!-- panel -->
        </div> <!-- col -->

        <div class="col-xs-12 col-md-8 col-lg-8">
            <div class="panel">
                <div class="panel-heading">
                    <h4 class="panel-title">Currency List</h4>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Action</th>
                            </tr>
                            </thead>

                            <tbody>
                            <Currency v-for="currency in currencies" :key="currency.id"  v-bind:currency="currency" v-on:delete-currency="deleteCurrency" v-on:update-currency="fetchCurrency">
                            </Currency>
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
    import Currency from './Currency.vue';
    export default {
        data(){
            return {
                currencies: [],
                errors: [],
                currency:{
                    name: '',
                    description: ''
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
        components:{ Currency },
        created(){
            this.fetchCurrency(this.pagination.current_page);
            //this.fetchCurrency();
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
            fetchCurrency: function(page){
                this.$http.get('/admin/currency/list?page='+page).then(response => {
                    //this.currencies = response.data.currency;
                    this.currencies  = response.data.currency.curr.data;
                    this.pagination = response.data.currency.pagination;
                    console.log(this.currencies);
                });
            },
            createCurrency(){
                this.$http.post('/admin/currency/add', this.currency).then(response => {
                    this.changePage(this.pagination.current_page);
                    this.currency = {name: '', description:''};
                    //this.currencies.push(response.data.currency);
                    if (this.errors) {
                        this.errors = [];
                    }
                    console.log(response.data);

                }, response => {
                    this.errors = response.data;
                });
            },
            deleteCurrency(currency){
                this.$http.delete('/admin/currency/delete/' + currency.id).then(response => {
                    this.changePage(this.pagination.current_page);
                    let index = this.currencies.indexOf(currency);
                    this.currencies.splice(index, 1);
                    console.log(response.data);
                });
            },

            changePage: function (page) {
                this.pagination.current_page = page;
                this.fetchCurrency(page);
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