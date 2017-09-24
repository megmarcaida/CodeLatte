<template>




    <tr>
        <td>
            <div class="form-group">
                <input type="text" id="name" class="form-control" v-model="editForm.name" v-if="edit">
                <span v-else>{{ courselist.name }}</span>
            </div>
        </td>
        <td>
            <div class="form-group">
                <input type="text" class="form-control" id="description"  v-model="editForm.description" v-if="edit">
                <span v-else>{{ courselist.description }}</span>
            </div>
        </td>
        <td>
            <div class="form-group">
                <select class="form-control" id="tutorials_id"  v-model="editForm.tutorials_id" v-if="edit">
                    <option v-bind:value="tutorial.id"  v-for="tutorial in tutorials">
                        {{ tutorial.name }}
                    </option>
                </select>
                <span v-else>{{ courselist.tutorials.name }}</span>
            </div>
        </td>
        <td>
            <button type="button" class="btn btn-info" v-on:click="editCourseList" v-if="!edit">
                Edit
            </button>

            <button type="button" class="btn btn-default" v-on:click="cancelEdit" v-if="edit">
                Cancel
            </button>

            <button type="button" class="btn btn-primary" v-on:click="updateCourseList(courselist, editForm)" v-if="edit">
                update
            </button>
            <button type="button" class="btn btn-danger" v-on:click="$emit('delete-courselist', courselist)" v-if="!edit">
                Delete
            </button>
        </td>
    </tr>
</template>

<script>
    export default {
        props:['courselist'],
        data(){
            return {
                courselists: [],
                edit: false,
                editForm :{
                    name: '',
                    description: '',
                    tutorials_id: ''
                }
            }
        },
        created(){
            this.fetchTutorials();
        }
        ,
        methods: {
            editCourseList(){
                this.edit = true;
                this.editForm.name = this.courselist.name;
                this.editForm.description = this.courselist.description;
                this.editForm.tutorials_id = this.courselist.tutorials_id;
            },
            cancelEdit(){
                this.edit = false;
                this.editForm.name = '';
                this.editForm.description = '';
                this.editForm.tutorials_id = '';
            },
            updateCourseList(oldCourseList, newCourseList){
                this.$http.patch('/admin/course-list/update/' + oldCourseList.id, newCourseList).then(response => {
                    this.$emit('update-courselist');
                    this.cancelEdit();
                    console.log(response.data);
                }, (response) => {
                    console.log(response.data);
                });
            },
            fetchTutorials(){
                this.$http.get('/admin/tutorials/list').then(response => {
                    this.tutorials = response.data.tutorial.tutorial.data;;
                    console.log(response)

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

