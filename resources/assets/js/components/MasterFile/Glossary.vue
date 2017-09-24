<template>




    <tr>
        <td>
            <div class="form-group">
                <input type="text" id="word" class="form-control" v-model="editForm.word" v-if="edit">
                <span v-else>{{ glossary.word }}</span>
            </div>
        </td>
        <td>
            <div class="form-group">
                <input type="text" class="form-control" id="definition"  v-model="editForm.definition" v-if="edit">
                <span v-else>{{ glossary.definition }}</span>
            </div>
        </td>
        <td>
            <button type="button" class="btn btn-info" v-on:click="editGlossary" v-if="!edit">
                Edit
            </button>

            <button type="button" class="btn btn-default" v-on:click="cancelEdit" v-if="edit">
                Cancel
            </button>

            <button type="button" class="btn btn-primary" v-on:click="updateGlossary(glossary, editForm)" v-if="edit">
                update
            </button>
            <button type="button" class="btn btn-danger" v-on:click="$emit('delete-glossary', glossary)" v-if="!edit">
                Delete
            </button>
        </td>
    </tr>
</template>

<script>
    export default {
        props:['glossary'],
        data(){
            return {
                edit: false,
                editForm :{
                    word: '',
                    definition: ''
                }
            }
        },
        methods: {
            editGlossary(){
                this.edit = true;
                this.editForm.word = this.glossary.word;
                this.editForm.definition = this.glossary.definition;
            },
            cancelEdit(){
                this.edit = false;
                this.editForm.word = '';
                this.editForm.definition = '';
            },
            updateGlossary(oldGlossary, newGlossary){
                this.$http.patch('/admin/glossary/update/' + oldGlossary.id, newGlossary).then(response => {
                    this.$emit('update-glossary');
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

