<template>

    <div>
        <div class="col-xs-12 col-md-4 col-lg-4">
            <div class="panel">
                <div class="panel-heading">
                    <h4 class="panel-title">Add Plans Content</h4>
                </div>
                <div class="panel-body">

                    <form v-on:submit.prevent="createPlansContent" method="post">

                        <div v-bind:class="{'form-group': true, 'has-error': errors.name}">
                            <label>Name:</label>
                            <input type="text" v-model="planscontent.name" class="form-control">
                            <span class="help-block" v-for="error in errors.name">{{ error }}</span>
                        </div>

                        <div v-bind:class="{'form-group': true, 'has-error': errors.description}">
                            <label>Description:</label>
                            <input type="text" v-model="planscontent.description" class="form-control">
                            <span class="help-block" v-for="error in errors.description">{{ error }}</span>
                        </div>

                        <div v-bind:class="{'form-group': true, 'has-error': errors.discount}">
                            <label>Plans:</label>
                            <!--<input type="text" v-model="planscontent.plans_id" class="form-control">-->
                            <select class="form-control" v-model="planscontent.plans_id">
                                <option v-bind:value="plan.id"  v-for="plan in plans">
                                    {{ plan.name }}
                                </option>
                            </select>
                            <span class="help-block" v-for="error in errors.plans_id">{{ error }}</span>
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
                    <h4 class="panel-title">Plans Content List</h4>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Plans</th>
                                <th>Action</th>
                            </tr>
                            </thead>

                            <tbody>
                            <PlansContent v-for="planscontent in planscontents" :key="planscontent.id"  v-bind:planscontent="planscontent"v-on:delete-planscontent="deletePlansContent" v-on:update-planscontent="fetchPlansContent">
                            </PlansContent>
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
    import PlansContent from './PlansContent.vue';
    export default {
        data(){
            return {
                planscontents: [],
                plans : [],
                errors: [],
                planscontent:{
                    name: '',
                    description: '',
                    plans_id: ''
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
        components:{ PlansContent },
        created(){
            this.fetchPlansContent(this.pagination.current_page);
            //this.fetchPlansContent();
            this.fetchPlans();
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
            fetchPlansContent: function(page){
                this.$http.get('/admin/plans-content/list?page='+page).then(response => {
                    this.planscontents  = response.data.planscontent.pc.data;
                    this.pagination = response.data.planscontent.pagination;
                    //this.planscontents = response.data.planscontent;
                    console.log(this.planscontents)

                });
            },
            createPlansContent(){
                this.$http.post('/admin/plans-content/add', this.planscontent).then(response => {
                    this.changePage(this.pagination.current_page);
                    //this.planscontents.push(response.data.planscontent);
                    this.planscontent = {name: '', description:'',plans_id :''};
                    if (this.errors) {
                        this.errors = [];
                    }
                    //console.log(response.data);
                }, response => {
                    this.errors = response.data;
                });
            },
            deletePlansContent(planscontent){
                this.$http.delete('/admin/plans-content/delete/' + planscontent.id).then(response => {
                    this.changePage(this.pagination.current_page);
                    let index = this.planscontents.indexOf(planscontent);
                    this.planscontents.splice(index, 1);
                    //console.log(response.data);
                });
            },
            fetchPlans(){
                this.$http.get('/admin/plans/list').then(response => {
                    this.plans = response.data.plans.plan.data;;
                    //console.log(this.plans)

                });
            },

            changePage: function (page) {
                this.pagination.current_page = page;
                this.fetchPlansContent(page);
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