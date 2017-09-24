<template>




    <tr>
        <td>
            <div class="form-group">
                <input type="text" id="name" class="form-control" v-model="editForm.name" v-if="edit">
                <span v-else>{{ programminglanguage.name }}</span>
            </div>
        </td>
        <td>
            <div class="form-group">
                <input type="text" class="form-control" id="definition"  v-model="editForm.description" v-if="edit">
                <span v-else>{{ programminglanguage.description }}</span>
            </div>
        </td>
        <td>
            <button type="button" class="btn btn-info" v-on:click="editProgrammingLanguage" v-if="!edit">
                Edit
            </button>

            <button type="button" class="btn btn-default" v-on:click="cancelEdit" v-if="edit">
                Cancel
            </button>

            <button type="button" class="btn btn-primary" v-on:click="updateProgrammingLanguage(programminglanguage, editForm)" v-if="edit">
                update
            </button>
            <button type="button" class="btn btn-danger" v-on:click="$emit('delete-programminglanguage', programminglanguage)" v-if="!edit">
                Delete
            </button>
        </td>
    </tr>
</template>

<script>
    export default {
        props:['programminglanguage'],
        data(){
            return {
                edit: false,
                editForm :{
                    name: '',
                    description: ''
                }
            }
        },
        methods: {
            editProgrammingLanguage(){
                this.edit = true;
                this.editForm.name = this.programminglanguage.name;
                this.editForm.description = this.programminglanguage.description;
            },
            cancelEdit(){
                this.edit = false;
                this.editForm.name = '';
                this.editForm.description = '';
            },
            updateProgrammingLanguage(oldProgrammingLanguage, newProgrammingLanguage){
                this.$http.patch('/admin/programminglanguage/update/' + oldProgrammingLanguage.id, newProgrammingLanguage).then(response => {
                    this.$emit('update-programminglanguage');
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

