<template>

    <div>
        <div class="col-xs-12 col-md-4 col-lg-4">
            <div class="panel">
                <div class="panel-heading">
                    <h4 class="panel-title">Add Programming Language</h4>
                </div>
                <div class="panel-body">

                    <form v-on:submit.prevent="createProgrammingLanguage" method="post">

                        <div v-bind:class="{'form-group': true, 'has-error': errors.name}">
                            <label>Name:</label>
                            <input type="text" v-model="programminglanguage.name" class="form-control">
                            <span class="help-block" v-for="error in errors.name">{{ error }}</span>
                        </div>

                        <div v-bind:class="{'form-group': true, 'has-error': errors.description}">
                            <label>Description:</label>
                            <input type="text" v-model="programminglanguage.description" class="form-control">
                            <span class="help-block" v-for="error in errors.description">{{ error }}</span>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Add New Programming Language</button>
                        </div>

                    </form>
                </div>
            </div><!-- panel -->
        </div> <!-- col -->

        <div class="col-xs-12 col-md-8 col-lg-8">
            <div class="panel">
                <div class="panel-heading">
                    <h4 class="panel-title">Programming Language List</h4>
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
                            <ProgrammingLanguage v-for="programminglanguage in programminglanguages" :key="programminglanguage.id"  v-bind:programminglanguage="programminglanguage"v-on:delete-programminglanguage="deleteProgrammingLanguage"v-on:update-programminglanguage="fetchProgrammingLanguage">
                            </ProgrammingLanguage>
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
    import ProgrammingLanguage from './ProgrammingLanguage.vue';
    export default {
        data(){
            return {
                programminglanguages: [],
                errors: [],
                programminglanguage:{
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
        components:{ ProgrammingLanguage },
        created(){
            this.fetchProgrammingLanguage(this.pagination.current_page);
            //this.fetchProgrammingLanguage();
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
            fetchProgrammingLanguage: function(page){
                this.$http.get('/admin/programminglanguage/list?page='+page).then(response => {
                    //this.programminglanguages = response.data.programminglanguage;
                    this.programminglanguages  = response.data.programminglanguage.prog.data;
                    this.pagination = response.data.programminglanguage.pagination;
                    console.log(this.programminglanguages);

                });
            },
            createProgrammingLanguage(){
                this.$http.post('/admin/programminglanguage/add', this.programminglanguage).then(response => {
                    this.changePage(this.pagination.current_page);
                    //this.programminglanguages.push(response.data.programminglanguage);
                    this.programminglanguage = {name: '', description:''};
                    if (this.errors) {
                        this.errors = [];
                    }
                    console.log(response.data);
                }, response => {
                    this.errors = response.data;
                });
            },
            deleteProgrammingLanguage(programminglanguage){
                this.$http.delete('/admin/programminglanguage/delete/' + programminglanguage.id).then(response => {
                    this.changePage(this.pagination.current_page);
                    let index = this.programminglanguages.indexOf(programminglanguage);
                    this.programminglanguages.splice(index, 1);
                    console.log(response.data);
                });
            },

            changePage: function (page) {
                this.pagination.current_page = page;
                this.fetchProgrammingLanguage(page);
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