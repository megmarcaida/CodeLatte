<template>

    <div>
        <div class="col-xs-12 col-md-4 col-lg-4">
            <div class="panel">
                <div class="panel-heading">
                    <h4 class="panel-title">Add Questionnaires </h4>
                </div>
                <div class="panel-body">

                    <form v-on:submit.prevent="createQuestionnaires" method="post">

                        <div v-bind:class="{'form-group': true, 'has-error': errors.quiz_id}">
                            <label>Quiz Name:</label>
                            <select class="form-control" v-model="questionnaires.quiz_id">
                                <option v-bind:value="quiz.id"  v-for="quiz in quizzes">
                                    {{ quiz.name }}
                                </option>
                            </select>
                            <span class="help-block" v-for="error in errors.quiz_id">{{ error }}</span>
                        </div>

                        <div v-bind:class="{'form-group': true, 'has-error': errors.question_text}">
                            <label>Question Text:</label>
                            <textarea type="text" v-model="questionnaires.question_text" class="form-control"></textarea>
                            <span class="help-block" v-for="error in errors.question_text">{{ error }}</span>
                        </div>

                        <div v-bind:class="{'form-group': true, 'has-error': errors.choice1}">
                            <label>Choice 1:</label>
                            <input type="text" v-model="questionnaires.choice1" class="form-control">
                            <span class="help-block" v-for="error in errors.choice1">{{ error }}</span>
                        </div>

                        <div v-bind:class="{'form-group': true, 'has-error': errors.choice2}">
                            <label>Choice 2:</label>
                            <input type="text" v-model="questionnaires.choice2" class="form-control">
                            <span class="help-block" v-for="error in errors.choice2">{{ error }}</span>
                        </div>

                        <div v-bind:class="{'form-group': true, 'has-error': errors.choice3}">
                            <label>Choice 3:</label>
                            <input type="text" v-model="questionnaires.choice3" class="form-control">
                            <span class="help-block" v-for="error in errors.choice3">{{ error }}</span>
                        </div>

                        <div v-bind:class="{'form-group': true, 'has-error': errors.choice4}">
                            <label>Choice 4:</label>
                            <input type="text" v-model="questionnaires.choice4" class="form-control">
                            <span class="help-block" v-for="error in errors.choice4">{{ error }}</span>
                        </div>

                        <div v-bind:class="{'form-group': true, 'has-error': errors.choice4}">
                            <label>Choice 5:</label>
                            <input type="text" v-model="questionnaires.choice5" class="form-control">
                            <span class="help-block" v-for="error in errors.choice5">{{ error }}</span>
                        </div>

                        <div v-bind:class="{'form-group': true, 'has-error': errors.correct_answer}">
                            <label>Correct Answer:</label>
                            <select class="form-control" v-model="questionnaires.correct_answer">
                                <option value="choice1">Choice 1</option>
                                <option value="choice2">Choice 2</option>
                                <option value="choice3">Choice 3</option>
                                <option value="choice4">Choice 4</option>
                                <option value="choice5">Choice 5</option>
                            </select>
                            <span class="help-block" v-for="error in errors.correct_answer">{{ error }}</span>
                        </div>

                        <div v-bind:class="{'form-group': true, 'has-error': errors.answer_explanation}">
                            <label>Answer Explanation:</label>
                            <textarea type="text" v-model="questionnaires.answer_explanation" class="form-control"></textarea>
                            <span class="help-block" v-for="error in errors.answer_explanation">{{ error }}</span>
                        </div>

                        <div v-bind:class="{'form-group': true, 'has-error': errors.code_snippet}">
                            <label>Code Snippet:</label>
                            <textarea type="text" v-model="questionnaires.code_snippet" class="form-control"></textarea>
                            <span class="help-block" v-for="error in errors.code_snippet">{{ error }}</span>
                        </div>

                        <div v-bind:class="{'form-group': true, 'has-error': errors.more_info_link}">
                            <label>More Info Link:</label>
                            <input type="text" v-model="questionnaires.more_info_link" class="form-control">
                            <span class="help-block" v-for="error in errors.more_info_link">{{ error }}</span>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Add New Questionnaires</button>
                        </div>

                    </form>
                </div>
            </div><!-- panel -->
        </div> <!-- col -->

        <div class="col-xs-12 col-md-8 col-lg-8">
            <div class="panel">
                <div class="panel-heading">
                    <h4 class="panel-title">Questionnaires List</h4>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>Quiz</th>
                                <th>Question Text</th>
                                <th>Choice 1</th>
                                <th>Choice 2</th>
                                <th>Choice 3</th>
                                <th>Choice 4</th>
                                <th>Choice 5</th>
                                <th>Correct Answer</th>
                                <th>Answer Explanation</th>
                                <th>Code Snippet</th>
                                <th>More Info Link</th>
                                <th>Action</th>
                            </tr>
                            </thead>

                            <tbody>
                            <Questionnaires v-for="questionnaire in questionnaires" :key="questionnaire.id"  v-bind:questionnaire="questionnaire"v-on:delete-questionnaire="deleteQuestionnaires" v-on:update-questionnaire="fetchQuestionnaires">
                            </Questionnaires>
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
    import Questionnaires from './Questionnaires.vue';
    export default {
        data(){
            return {
                questionnaires: [],
                quizzes : [],
                errors: [],
                questionnaire:{
                    quiz_id: '',
                    question_text: '',
                    code_snippet: '',
                    answer_explanation: '',
                    more_info_link: '',
                    choice1: '',
                    choice2: '',
                    choice3: '',
                    choice4: '',
                    choice5: '',
                    correct_answer: ''

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
        components:{ Questionnaires },
        created(){
            this.fetchQuestionnaires(this.pagination.current_page);
            this.fetchQuiz();
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
            fetchQuestionnaires: function(page){
                this.$http.get('/admin/questionnaires/list?page='+page).then(response => {
                    this.questionnaires  = response.data.questionnaires.questionnaires.data;
                    this.pagination = response.data.questionnaires.pagination;


                });
            },
            createQuestionnaires(){
                this.$http.post('/admin/questionnaires/add', this.questionnaire).then(response => {
                    this.changePage(this.pagination.current_page);
                    this.questionnaire = {quiz_id: '', question_text:'',code_snippet:'',answer_explanation :'',more_info_link:'',choice1:'',choice2:'',choice3:'',choice4:'',choice5:'',correct_answer:''};
                    if (this.errors) {
                        this.errors = [];
                    }

                }, response => {
                    this.errors = response.data;
                });
            },
            deleteQuestionnaires(questionnaire){
                this.$http.delete('/admin/questionnaires/delete/' + questionnaire.id).then(response => {
                    this.changePage(this.pagination.current_page);
                    let index = this.questionnaires.indexOf(questionnaire);
                    this.questionnaires.splice(index, 1);

                });
            },
            fetchQuiz(){
                this.$http.get('/admin/quiz/list').then(response => {
                    this.quizzes = response.data.quiz.quiz.data;


                });
            },

            changePage: function (page) {
                this.pagination.current_page = page;
                this.fetchQuestionnaires(page);
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