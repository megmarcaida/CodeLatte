<template>

    <div>
        <div class="col-xs-12 col-md-4 col-lg-4">
            <div class="panel">
                <div class="panel-heading">
                    <h4 class="panel-title">Add Course </h4>
                </div>
                <div class="panel-body">

                    <form v-on:submit.prevent="createCourseList" method="post">

                        <div v-bind:class="{'form-group': true, 'has-error': errors.name}">
                            <label>Name:</label>
                            <input type="text" v-model="courselist.name" class="form-control">
                            <span class="help-block" v-for="error in errors.name">{{ error }}</span>
                        </div>

                        <div v-bind:class="{'form-group': true, 'has-error': errors.description}">
                            <label>Description:</label>
                            <input type="text" v-model="courselist.description" class="form-control">
                            <span class="help-block" v-for="error in errors.description">{{ error }}</span>
                        </div>

                        <div v-bind:class="{'form-group': true, 'has-error': errors.tutorials_id}">
                            <label>Tutorial:</label>
                            <select class="form-control" v-model="courselist.tutorials_id">
                                <option v-bind:value="tutorial.id"  v-for="tutorial in tutorials">
                                    {{ tutorial.name }}
                                </option>
                            </select>
                            <span class="help-block" v-for="error in errors.tutorials_id">{{ error }}</span>
                        </div>


                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Add New Tutorials</button>
                        </div>

                    </form>
                </div>
            </div><!-- panel -->
        </div> <!-- col -->

        <div class="col-xs-12 col-md-8 col-lg-8">
            <div class="panel">
                <div class="panel-heading">
                    <h4 class="panel-title">Tutorials List</h4>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Tutorials</th>
                                <th>Action</th>
                            </tr>
                            </thead>

                            <tbody>
                            <CourseList v-for="courselist in courselists" :key="courselist.id"  v-bind:courselist="courselist"v-on:delete-courselist="deleteCourseList" v-on:update-courselist="fetchCourseList">
                            </CourseList>
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
    import CourseList from './CourseList.vue';
    export default {
        data(){
            return {
                courselists: [],
                tutorials:[],
                errors: [],
                courselist:{
                    name: '',
                    description: '',
                    tutorials_id: '',
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
        components:{ CourseList },
        created(){
            this.fetchCourseList(this.pagination.current_page);
            this.fetchTutorials();
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
            fetchCourseList: function(page){
                this.$http.get('/admin/course-list/list?page='+page).then(response => {
                    this.courselists  = response.data.courselist.courselist.data;
                    this.pagination = response.data.courselist.pagination;


                });
            },
            createCourseList(){
                this.$http.post('/admin/course-list/add', this.courselist).then(response => {
                    this.changePage(this.pagination.current_page);
                    this.courselist = {name: '', description:'',tutorials_id:''};
                    if (this.errors) {
                        this.errors = [];
                    }

                }, response => {
                    this.errors = response.data;
                });
            },
            deleteCourseList(tutorial){
                this.$http.delete('/admin/course-list/delete/' + courselist.id).then(response => {
                    this.changePage(this.pagination.current_page);
                    let index = this.tutorials.indexOf(tutorial);
                    this.tutorials.splice(index, 1);

                });
            },
            fetchTutorials(){
                this.$http.get('/admin/tutorials/list').then(response => {
                    this.tutorials = response.data.tutorial.tutorial.data;


                });
            },

            changePage: function (page) {
                this.pagination.current_page = page;
                this.fetchTutorials(page);
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