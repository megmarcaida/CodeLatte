<template>




    <tr>
        <td>
            <div class="form-group">

            </div>
        </td>
        <td>
            <div class="form-group">
                <input type="text" class="form-control" id="description"  v-model="editForm.description" v-if="edit">
                <span v-else>{{ media.description }}</span>
            </div>
        </td>
        <td>
            <button type="button" class="btn btn-info" v-on:click="editMedia" v-if="!edit">
                Edit
            </button>

            <button type="button" class="btn btn-default" v-on:click="cancelEdit" v-if="edit">
                Cancel
            </button>

            <button type="button" class="btn btn-primary" v-on:click="updateMedia(media, editForm)" v-if="edit">
                update
            </button>
            <button type="button" class="btn btn-danger" v-on:click="$emit('delete-media', media)" v-if="!edit">
                Delete
            </button>
        </td>
    </tr>
</template>

<script>
    export default {
        props:['media'],
        data(){
            return {
                edit: false,
                editForm :{
                    description: ''
                }
            }
        },
        methods: {
            editMedia(){
                this.edit = true;
                this.editForm.description = this.media.description;
            },
            cancelEdit(){
                this.edit = false;
                this.editForm.description = '';
            },
            updateMedia(oldMedia, newMedia){
                this.$http.patch('/admin/media/update/' + oldMedia.id, newMedia).then(response => {
                    this.$emit('update-media');
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

