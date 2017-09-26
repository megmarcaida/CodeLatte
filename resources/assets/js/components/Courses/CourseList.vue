<template>




    <tbody>
    <tr>
        <td><a v-on:click="fetchCourseDetails(courselist)" class="showCourseDetails" href="#"><i v-if="!showDetails" class="glyphicon glyphicon-plus"></i><i v-if="showDetails" class="glyphicon glyphicon-minus"></i></a>
            </td>
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
    <tr class="courseDetails"  style="display: none;">
        <table>
            <thead>
            <th>Name</th>
            <th>Description</th>
            </thead>
            <CourseDetails v-for="coursedetail in courseDetails" :key="coursedetail.id"  v-bind:coursedetail="coursedetail"></CourseDetails>
        </table>
    </tr>

    </tbody>
</template>

<script>
    import CourseDetails from './CourseDetails.vue';
    export default {
        props:['courselist'],
        data(){
            return {
                courselists: [],
                courseDetails: [],
                edit: false,
                editForm :{
                    name: '',
                    description: ''

                },
                showDetails: false

            }
        },
        components:{ CourseDetails },
        methods: {
            editCourseList(){
                this.edit = true;
                this.editForm.name = this.courselist.name;
                this.editForm.description = this.courselist.description;

            },
            cancelEdit(){
                this.edit = false;
                this.editForm.name = '';
                this.editForm.description = '';

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
            fetchCourseDetails: function(courselist){

                if (this.showDetails==false){
                    this.showDetails = true;
                }
                else{
                    this.showDetails = false;
                }
                this.$http.get('/admin/course-list/details/'+courselist.id).then(response => {
                    this.courseDetails  = response.data.coursedetails.coursedetails.data;


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

