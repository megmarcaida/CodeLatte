<template>




    <tr>
        <td>
            <div class="form-group">
                <input type="text" id="name" class="form-control" v-model="editForm.name" v-if="edit">
                <span v-else>{{ tutorial.name }}</span>
            </div>
        </td>
        <td>
            <div class="form-group">
                <input type="text" class="form-control" id="description"  v-model="editForm.description" v-if="edit">
                <span v-else>{{ tutorial.description }}</span>
            </div>
        </td>
        <td>
            <div class="form-group">
                <textarea type="text" class="form-control" id="textarea"  v-model="editForm.textarea" v-if="edit"></textarea>
                <span v-else>{{ tutorial.textarea }}</span>
            </div>
        </td>
        <td>
            <div class="form-group">
                <select class="form-control" id="programminglanguage_id"  v-model="editForm.programminglanguage_id" v-if="edit">
                    <option v-bind:value="proglang.id"  v-for="proglang in programminglanguage">
                        {{ proglang.name }}
                    </option>
                </select>
                <span v-else>{{ tutorial.programminglanguage.name }}</span>
            </div>
        </td>
        <td>
            <div class="form-group">
                <select class="form-control" id="media_id"  v-model="editForm.media_id" v-if="edit">
                    <option v-bind:value="med.id"  v-for="med in media">
                        {{ med.title }}
                    </option>
                </select>
                <span v-else>{{ tutorial.media.title }}</span>
            </div>
        </td>
        <td>
            <div class="form-group">
                <select class="form-control" id="course_id"  v-model="editForm.course_id" v-if="edit">
                    <option v-bind:value="course.id"  v-for="course in courselist">
                        {{ course.name }}
                    </option>
                </select>
                <span v-else>{{ tutorial.courselist.name}}</span>
            </div>
        </td>
        <td>
            <div class="form-group">
                <span>{{ tutorial.views }}</span>
            </div>
        </td>
        <td>
            <button type="button" class="btn btn-info" v-on:click="editTutorials" v-if="!edit">
                Edit
            </button>

            <button type="button" class="btn btn-default" v-on:click="cancelEdit" v-if="edit">
                Cancel
            </button>

            <button type="button" class="btn btn-primary" v-on:click="updateTutorials(tutorial, editForm)" v-if="edit">
                update
            </button>
            <button type="button" class="btn btn-danger" v-on:click="$emit('delete-tutorial', tutorial)" v-if="!edit">
                Delete
            </button>
        </td>
    </tr>
</template>

<script>
    export default {
        props:['tutorial'],
        data(){
            return {
                tutorials: [],
                edit: false,
                editForm :{
                    name: '',
                    description: '',
                    programminglanguage_id:'',
                    textarea:'',
                    media_id: '',
                    course_id: ''
                }
            }
        },
        created(){
            this.fetchProgrammingLanguage();
            this.fetchMedia();
            this.fetchCourseList();
        }
        ,
        methods: {
            editTutorials(){
                this.edit = true;
                this.editForm.name = this.tutorial.name;
                this.editForm.description = this.tutorial.description;
                this.editForm.textarea = this.tutorial.textarea;
                this.editForm.programminglanguage_id = this.tutorial.programminglanguage_id;
                this.editForm.media_id = this.tutorial.media_id;
                this.editForm.course_id = this.tutorial.course_id;
            },
            cancelEdit(){
                this.edit = false;
                this.editForm.name = '';
                this.editForm.description = '';
                this.editForm.programminglanguage_id = '';
                this.editForm.media_id = '';
                this.editForm.course_id = '';
            },
            updateTutorials(oldTutorials, newTutorials){
                this.$http.patch('/admin/tutorials/update/' + oldTutorials.id, newTutorials).then(response => {
                    this.$emit('update-tutorial');
                    this.cancelEdit();
                    //console.log(response.data);
                }, (response) => {
                    //console.log(response.data);
                });
            },
            fetchProgrammingLanguage(){
                this.$http.get('/admin/programminglanguage/list').then(response => {
                    this.programminglanguage = response.data.programminglanguage.prog.data;;
                    //console.log(response)

                });
            },
            fetchMedia(){
                this.$http.get('/admin/media/list').then(response => {
                    this.media = response.data.media.media.data;;
                    //console.log(response)

                });
            },
            fetchCourseList(){
                this.$http.get('/admin/course-list/list').then(response => {
                    this.courselist = response.data.courselist.courselist.data;;
                    //console.log(response)

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

