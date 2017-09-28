<template>

    <div>
        <div class="col-xs-12 col-md-4 col-lg-4">
            <div class="panel">
                <div class="panel-heading">
                    <h4 class="panel-title">Add Quiz </h4>
                </div>
                <div class="panel-body">

                    <form v-on:submit.prevent="createQuiz" method="post">

                        <div v-bind:class="{'form-group': true, 'has-error': errors.name}">
                            <label>Name:</label>
                            <input type="text" v-model="quiz.name" class="form-control">
                            <span class="help-block" v-for="error in errors.name">{{ error }}</span>
                        </div>

                        <div v-bind:class="{'form-group': true, 'has-error': errors.description}">
                            <label>Description:</label>
                            <input type="text" v-model="quiz.description" class="form-control">
                            <span class="help-block" v-for="error in errors.description">{{ error }}</span>
                        </div>

                        <div v-bind:class="{'form-group': true, 'has-error': errors.tutorial_id}">
                            <label>Tutorial:</label>
                            <select class="form-control" v-model="quiz.tutorial_id">
                                <option v-bind:value="tutorial.id"  v-for="tutorial in tutorials">
                                    {{ tutorial.name }}
                                </option>
                            </select>
                            <span class="help-block" v-for="error in errors.tutorial_id">{{ error }}</span>
                        </div>


                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Add New Quiz</button>
                        </div>

                    </form>
                </div>
            </div><!-- panel -->
        </div> <!-- col -->

        <div class="col-xs-12 col-md-8 col-lg-8">
            <div class="panel">
                <div class="panel-heading">
                    <h4 class="panel-title">Quiz List</h4>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">


                        <Quiz v-for="quiz in quizzes" :key="quiz.id"  v-bind:quiz="quiz"v-on:delete-quiz="deleteQuiz" v-on:update-quiz="fetchQuiz">
                        </Quiz>


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
    import Quiz from './Quiz.vue';
    export default {
        data(){
            return {
                quizzes: [],
                errors: [],
                tutorials: [],
                quiz:{
                    name: '',
                    description: '',

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
        components:{ Quiz },
        created(){
            this.fetchQuiz(this.pagination.current_page);
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
            fetchQuiz: function(page){
                this.$http.get('/admin/quiz/list?page='+page).then(response => {
                    this.quizzes  = response.data.quiz.quiz.data;
                    this.pagination = response.data.quiz.pagination;


                });
            },
            createQuiz(){
                this.$http.post('/admin/quiz/add', this.quiz).then(response => {
                    this.changePage(this.pagination.current_page);
                    this.quiz = {name: '', description:''};
                    if (this.errors) {
                        this.errors = [];
                    }

                }, response => {
                    this.errors = response.data;
                });
            },
            deleteQuiz(quiz){
                this.$http.delete('/admin/quiz/delete/' + quiz.id).then(response => {
                    this.changePage(this.pagination.current_page);
                    let index = this.quizzes.indexOf(quiz);
                    this.quizzes.splice(index, 1);

                });
            },

            changePage: function (page) {
                this.pagination.current_page = page;
                this.fetchQuiz(page);
            },
            fetchTutorials(){
                this.$http.get('/admin/tutorials/list').then(response => {
                    this.tutorials = response.data.tutorial.tutorial.data;;


                });
            },
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