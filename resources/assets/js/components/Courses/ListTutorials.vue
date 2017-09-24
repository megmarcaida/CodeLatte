<template>

    <div>
        <div class="col-xs-12 col-md-4 col-lg-4">
            <div class="panel">
                <div class="panel-heading">
                    <h4 class="panel-title">Add Tutorials </h4>
                </div>
                <div class="panel-body">

                    <form v-on:submit.prevent="createTutorials" method="post">

                        <div v-bind:class="{'form-group': true, 'has-error': errors.name}">
                            <label>Name:</label>
                            <input type="text" v-model="tutorial.name" class="form-control">
                            <span class="help-block" v-for="error in errors.name">{{ error }}</span>
                        </div>

                        <div v-bind:class="{'form-group': true, 'has-error': errors.description}">
                            <label>Description:</label>
                            <input type="text" v-model="tutorial.description" class="form-control">
                            <span class="help-block" v-for="error in errors.description">{{ error }}</span>
                        </div>

                        <div v-bind:class="{'form-group': true, 'has-error': errors.textarea}">
                            <label>Text Content:</label>
                            <textarea type="text" v-model="tutorial.textarea" class="form-control"></textarea>
                            <span class="help-block" v-for="error in errors.textarea">{{ error }}</span>
                        </div>

                        <div v-bind:class="{'form-group': true, 'has-error': errors.programminglanguage_id}">
                            <label>Programming Languages:</label>
                            <select class="form-control" v-model="tutorial.programminglanguage_id">
                                <option v-bind:value="proglang.id"  v-for="proglang in programminglanguage">
                                    {{ proglang.name }}
                                </option>
                            </select>
                            <span class="help-block" v-for="error in errors.programminglanguage_id">{{ error }}</span>
                        </div>

                        <div v-bind:class="{'form-group': true, 'has-error': errors.media_id}">
                            <label>Media:</label>
                            <select class="form-control" v-model="tutorial.media_id">
                                <option v-bind:value="med.id"  v-for="med in media">
                                    {{ med.title }}
                                </option>
                            </select>
                            <span class="help-block" v-for="error in errors.media_id">{{ error }}</span>
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
                                <th>Text Content</th>
                                <th>Programming Language</th>
                                <th>Media</th>
                                <th>Views</th>
                                <th>Action</th>
                            </tr>
                            </thead>

                            <tbody>
                            <Tutorials v-for="tutorial in tutorials" :key="tutorial.id"  v-bind:tutorial="tutorial"v-on:delete-tutorial="deleteTutorials" v-on:update-tutorial="fetchTutorials">
                            </Tutorials>
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
    import Tutorials from './Tutorials.vue';
    export default {
        data(){
            return {
                tutorials: [],
                programminglanguage : [],
                media:[],
                errors: [],
                tutorial:{
                    name: '',
                    description: '',
                    textarea: '',
                    programminglanguage_id: '',
                    media_id: ''
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
        components:{ Tutorials },
        created(){
            this.fetchTutorials(this.pagination.current_page);
            this.fetchProgrammingLanguage();
            this.fetchMedia();
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
            fetchTutorials: function(page){
                this.$http.get('/admin/tutorials/list?page='+page).then(response => {
                    this.tutorials  = response.data.tutorial.tutorial.data;
                    this.pagination = response.data.tutorial.pagination;


                });
            },
            createTutorials(){
                this.$http.post('/admin/tutorials/add', this.tutorial).then(response => {
                    this.changePage(this.pagination.current_page);
                    this.tutorial = {name: '', description:'',textarea:'',programminglanguage_id :'',media_id:''};
                    if (this.errors) {
                        this.errors = [];
                    }

                }, response => {
                    this.errors = response.data;
                });
            },
            deleteTutorials(tutorial){
                this.$http.delete('/admin/tutorials/delete/' + tutorial.id).then(response => {
                    this.changePage(this.pagination.current_page);
                    let index = this.tutorials.indexOf(tutorial);
                    this.tutorials.splice(index, 1);

                });
            },
            fetchProgrammingLanguage(){
                this.$http.get('/admin/programminglanguage/list').then(response => {
                    this.programminglanguage = response.data.programminglanguage.prog.data;;


                });
            },
            fetchMedia(){
                this.$http.get('/admin/media/list').then(response => {
                    this.media = response.data.media.media.data;;


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