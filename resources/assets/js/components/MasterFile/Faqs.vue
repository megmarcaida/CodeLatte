<template>




    <tr>
        <td>
                            <div class="form-group">
                                <input type="text" id="question" class="form-control" v-model="editForm.question" v-if="edit">
                                <span v-else>{{ faq.question }}</span>
                            </div>
        </td>
        <td>
                            <div class="form-group">
                                <input type="text" class="form-control" id="answer"  v-model="editForm.answer" v-if="edit">
                                <span v-else>{{ faq.answer }}</span>
                            </div>
        </td>
        <td>
                            <button type="button" class="btn btn-info" v-on:click="editFaq" v-if="!edit">
                                Edit
                            </button>

                            <button type="button" class="btn btn-default" v-on:click="cancelEdit" v-if="edit">
                                Cancel
                            </button>

                            <button type="button" class="btn btn-primary" v-on:click="updateFaqs(faq, editForm)" v-if="edit">
                                update
                            </button>
                            <button type="button" class="btn btn-danger" v-on:click="$emit('delete-faq', faq)" v-if="!edit">
                                Delete
                            </button>
        </td>
    </tr>
</template>

<script>
    export default {
        props:['faq'],
        data(){
            return {
                edit: false,
                editForm :{
                    question: '',
                    answer: ''
                }
            }
        },
        methods: {
            editFaq(){
                this.edit = true;
                this.editForm.question = this.faq.question;
                this.editForm.answer = this.faq.answer;
            },
            cancelEdit(){
                this.edit = false;
                this.editForm.question = '';
                this.editForm.answer = '';
            },
            updateFaqs(oldFaq, newFaq){
                this.$http.patch('/admin/faqs/update/' + oldFaq.id, newFaq).then(response => {
                    this.$emit('update-faq');
                    this.cancelEdit();
                    console.log(response.data);
                }, (response) => {
                    console.log(response.data);
                });
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

