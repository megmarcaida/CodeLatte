<template>

    <div>
        <div class="col-xs-12 col-md-4 col-lg-4">
            <div class="panel">
                <div class="panel-heading">
                    <h4 class="panel-title">Add Plan</h4>
                </div>
                <div class="panel-body">

                    <form v-on:submit.prevent="createPlan" method="post">

                        <div v-bind:class="{'form-group': true, 'has-error': errors.name}">
                            <label>Name:</label>
                            <input type="text" v-model="plan.name" class="form-control">
                            <span class="help-block" v-for="error in errors.name">{{ error }}</span>
                        </div>

                        <div v-bind:class="{'form-group': true, 'has-error': errors.definition}">
                            <label>Price:</label>
                            <input type="number" v-model="plan.price" class="form-control">
                            <span class="help-block" v-for="error in errors.price">{{ error }}</span>
                        </div>

                        <div v-bind:class="{'form-group': true, 'has-error': errors.discount}">
                            <label>Discount:</label>
                            <input type="number" v-model="plan.discount" class="form-control">
                            <span class="help-block" v-for="error in errors.discount">{{ error }}</span>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Add New Plan</button>
                        </div>

                    </form>
                </div>
            </div><!-- panel -->
        </div> <!-- col -->

        <div class="col-xs-12 col-md-8 col-lg-8">
            <div class="panel">
                <div class="panel-heading">
                    <h4 class="panel-title">Plans List</h4>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Price</th>
                                <th>Discount</th>
                                <th>Action</th>
                            </tr>
                            </thead>

                            <tbody>
                            <Plans v-for="plan in plans" :key="plan.id"  v-bind:plan="plan"v-on:delete-plan="deletePlan"v-on:update-plan="fetchPlan">
                            </Plans>
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
    import Plans from './Plans.vue';
    export default {
        data(){
            return {
                plans: [],
                errors: [],
                plan:{
                    name: '',
                    price: '',
                    discount: ''
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
        components:{ Plans },
        created(){
            this.fetchPlan(this.pagination.current_page);
            //this.fetchPlan();
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
            fetchPlan: function(page){
                this.$http.get('/admin/plans/list?page='+page).then(response => {
                    //this.plans = response.data.plans;
                    this.plans  = response.data.plans.plan.data;
                    this.pagination = response.data.plans.pagination;
                    console.log(this.plans);

                });
            },
            createPlan(){
                this.$http.post('/admin/plans/add', this.plan).then(response => {
                    this.changePage(this.pagination.current_page);
                    //this.plans.push(response.data.plans);
                    this.plan = {name: '', price:''};
                    if (this.errors) {
                        this.errors = [];
                    }
                    console.log(response.data);
                }, response => {
                    this.errors = response.data;
                });
            },
            deletePlan(plan){
                this.$http.delete('/admin/plans/delete/' + plan.id).then(response => {
                    this.changePage(this.pagination.current_page);
                    let index = this.plans.indexOf(plan);
                    this.plans.splice(index, 1);
                    console.log(response.data);
                });
            },

            changePage: function (page) {
                this.pagination.current_page = page;
                this.fetchPlan(page);
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