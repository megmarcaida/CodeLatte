<template>

    <div>
        <table class="table table-striped">
            <thead>
            <tr>
                <th></th>
                <th>Name</th>
                <th>Description</th>
                <th>Tutorial Name</th>
                <th>Action</th>
            </tr>
            </thead>

            <tbody>
            <tr>
                <td><a v-on:click="fetchQuizDetails(quiz)" class="showQuizDetails" href="#"><i v-if="!showDetails" class="glyphicon glyphicon-plus"></i><i v-if="showDetails" class="glyphicon glyphicon-minus"></i></a>
                </td>
                <td>
                    <div class="form-group">
                        <input type="text" id="name" class="form-control" v-model="editForm.name" v-if="edit">
                        <span v-else>{{ quiz.name }}</span>
                    </div>
                </td>
                <td>
                    <div class="form-group">
                        <input type="text" class="form-control" id="description"  v-model="editForm.description" v-if="edit">
                        <span v-else>{{ quiz.description }}</span>
                    </div>
                </td>
                <td>
                    <div class="form-group">
                        <select class="form-control" id="tutorial_id"  v-model="editForm.tutorial_id" v-if="edit">
                            <option v-bind:value="tutorial.id"  v-for="tutorial in tutorials">
                                {{ tutorial.name }}
                            </option>
                        </select>
                        <span v-else>{{ quiz.tutorials.name }}</span>
                    </div>
                </td>
                <td>
                    <button type="button" class="btn btn-info" v-on:click="editQuiz" v-if="!edit">
                        Edit
                    </button>

                    <button type="button" class="btn btn-default" v-on:click="cancelEdit" v-if="edit">
                        Cancel
                    </button>

                    <button type="button" class="btn btn-primary" v-on:click="updateQuiz(quiz, editForm)" v-if="edit">
                        update
                    </button>
                    <button type="button" class="btn btn-danger" v-on:click="$emit('delete-quiz', quiz)" v-if="!edit">
                        Delete
                    </button>

                </td>
            </tr>
            </tbody>
        </table>
        <table class="table table-striped quizDetails" style="display:none;">

            <thead>
            <tr>
                <th>Questionnaire Name</th>
                <th>Questionnaire Description</th>
            </tr>
            </thead>
            <tbody>
            <QuizDetails v-for="quizdetail in quizDetails" :key="quizdetail.id"  v-bind:quizdetail="quizdetail"></QuizDetails>
            </tbody>
        </table>
    </div>
</template>

<script>
    import QuizDetails from './QuizDetails.vue';
    export default {
        props:['quiz'],
        data(){
            return {
                quizzes: [],
                quizDetails: [],
                tutorials:[],
                edit: false,
                editForm :{
                    name: '',
                    description: '',
                    tutorial_id: ''

                },
                showDetails: false

            }
        },
        created(){
            this.fetchTutorials();
        },
        components:{ QuizDetails },
        methods: {
            editQuiz(){
                this.edit = true;
                this.editForm.name = this.quiz.name;
                this.editForm.description = this.quiz.description;
                this.editForm.tutorial_id = this.quiz.tutorial_id;

            },
            cancelEdit(){
                this.edit = false;
                this.editForm.name = '';
                this.editForm.description = '';
                this.editForm.tutorial_id = '';

            },
            updateQuiz(oldQuiz, newQuiz){
                this.$http.patch('/admin/quiz/update/' + oldQuiz.id, newQuiz).then(response => {
                    this.$emit('update-quiz');
                    this.cancelEdit();
                    console.log(response.data);
                }, (response) => {
                    console.log(response.data);
                });
            },
            fetchQuizDetails: function(quiz){

                if (this.showDetails==false){
                    this.showDetails = true;
                }
                else{
                    this.showDetails = false;
                }
                this.$http.get('/admin/quiz/details/'+quiz.id).then(response => {
                    this.quizDetails  = response.data.quizdetails.quizdetails.data;


                });
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

