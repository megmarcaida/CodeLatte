<template>




    <tr>
        <td>
            <div class="form-group">
                <select class="form-control" id="quiz_id"  v-model="editForm.quiz_id" v-if="edit">
                    <option v-bind:value="quiz.id"  v-for="quiz in quizzes">
                        {{ quiz.name }}
                    </option>
                </select>
                <span v-else>{{ questionnaire.quiz.name }}</span>
            </div>
        </td>
        <td>
            <div class="form-group">
                <input type="text" id="name" class="form-control" v-model="editForm.name" v-if="edit">
                <span v-else>{{ questionnaire.name }}</span>
            </div>
        </td>
        <td>
            <div class="form-group">
                <textarea type="text" class="form-control" id="question_text"  v-model="editForm.question_text" v-if="edit"></textarea>
                <span v-else>{{ questionnaire.question_text }}</span>
            </div>
        </td>
        <td>
            <div class="form-group">
                <textarea type="text" class="form-control" id="code_snippet"  v-model="editForm.code_snippet" v-if="edit"></textarea>
                <span v-else>{{ questionnaire.code_snippet }}</span>
            </div>
        </td>
        <td>
            <div class="form-group">
                <textarea type="text" class="form-control" id="answer_explanation"  v-model="editForm.answer_explanation" v-if="edit"></textarea>
                <span v-else>{{ questionnaire.answer_explanation }}</span>
            </div>
        </td>
        <td>
            <div class="form-group">
                <input type="text" id="more_info_link" class="form-control" v-model="editForm.more_info_link" v-if="edit">
                <span v-else>{{ questionnaire.more_info_link }}</span>
            </div>
        </td>
        <td>
            <div class="form-group">
                <input type="text" id="choice1" class="form-control" v-model="editForm.choice1" v-if="edit">
                <span v-else>{{ questionnaire.choice1 }}</span>
            </div>
        </td>
        <td>
            <div class="form-group">
                <input type="text" id="choice2" class="form-control" v-model="editForm.choice2" v-if="edit">
                <span v-else>{{ questionnaire.choice2 }}</span>
            </div>
        </td>
        <td>
            <div class="form-group">
                <input type="text" id="choice3" class="form-control" v-model="editForm.choice3" v-if="edit">
                <span v-else>{{ questionnaire.choice3 }}</span>
            </div>
        </td>
        <td>
            <div class="form-group">
                <input type="text" id="choice4" class="form-control" v-model="editForm.choice4" v-if="edit">
                <span v-else>{{ questionnaire.choice4 }}</span>
            </div>
        </td>
        <td>
            <div class="form-group">
                <input type="text" id="choice5" class="form-control" v-model="editForm.choice5" v-if="edit">
                <span v-else>{{ questionnaire.choice5 }}</span>
            </div>
        </td>
        <td>
            <button type="button" class="btn btn-info" v-on:click="editQuestionnaires" v-if="!edit">
                Edit
            </button>

            <button type="button" class="btn btn-default" v-on:click="cancelEdit" v-if="edit">
                Cancel
            </button>

            <button type="button" class="btn btn-primary" v-on:click="updateQuestionnaires(questionnaires, editForm)" v-if="edit">
                update
            </button>
            <button type="button" class="btn btn-danger" v-on:click="$emit('delete-questionnaires', questionnaires)" v-if="!edit">
                Delete
            </button>
        </td>
    </tr>
</template>

<script>
    export default {
        props:['questionnaire'],
        data(){
            return {
                questionnaires: [],
                edit: false,
                quizzes:[],
                editForm :{
                    quiz_id: '',
                    question_text: '',
                    code_snippet:'',
                    answer_explanation:'',
                    choice1: '',
                    choice2: '',
                    choice3: '',
                    choice4: '',
                    choice5: '',
                    correct_answer: '',
                    more_info_link: ''
                }
            }
        },
        created(){
            this.fetchQuiz
        }
        ,
        methods: {
            editQuestionnaires(){
                this.edit = true;
                this.editForm.quiz_id = this.questionnaire.quiz_id;
                this.editForm.question_text = this.questionnaire.question_text;
                this.editForm.code_snippet = this.questionnaire.code_snippet;
                this.editForm.answer_explanation = this.questionnaire.answer_explanation;
                this.editForm.more_info_link = this.questionnaire.more_info_link;
                this.editForm.choice1 = this.questionnaire.choice1;
                this.editForm.choice2 = this.questionnaire.choice2;
                this.editForm.choice3 = this.questionnaire.choice3;
                this.editForm.choice4 = this.questionnaire.choice4;
                this.editForm.choice5 = this.questionnaire.choice5;
                this.editForm.correct_answer = this.questionnaire.correct_answer;
            },
            cancelEdit(){
                this.edit = false;
                this.editForm.quiz_id = '';
                this.editForm.question_text = '';
                this.editForm.code_snippet = '';
                this.editForm.answer_explanation = '';
                this.editForm.more_info_link = '';
                this.editForm.choice1 = '';
                this.editForm.choice2 = '';
                this.editForm.choice3 = '';
                this.editForm.choice4 = '';
                this.editForm.choice5 = '';
                this.editForm.correct_answer = '';

            },
            updateQuestionnaires(oldQuestionnaires, newQuestionnaires){
                this.$http.patch('/admin/questionnaires/update/' + oldQuestionnaires.id, newQuestionnaires).then(response => {
                    this.$emit('update-questionnaire');
                    this.cancelEdit();
                    //console.log(response.data);
                }, (response) => {
                    //console.log(response.data);
                });
            },
            fetchQuiz(){
                this.$http.get('/admin/quiz/list').then(response => {
                    this.quizzes = response.data.quiz.quiz.data;;


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

