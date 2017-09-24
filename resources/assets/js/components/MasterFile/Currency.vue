<template>




    <tr>
        <td>
            <div class="form-group">
                <input type="text" id="name" class="form-control" v-model="editForm.name" v-if="edit">
                <span v-else>{{ currency.name }}</span>
            </div>
        </td>
        <td>
            <div class="form-group">
                <input type="text" class="form-control" id="description"  v-model="editForm.description" v-if="edit">
                <span v-else>{{ currency.description }}</span>
            </div>
        </td>
        <td>
            <button type="button" class="btn btn-info" v-on:click="editCurrency" v-if="!edit">
                Edit
            </button>

            <button type="button" class="btn btn-default" v-on:click="cancelEdit" v-if="edit">
                Cancel
            </button>

            <button type="button" class="btn btn-primary" v-on:click="updateCurrency(currency, editForm)" v-if="edit">
                update
            </button>
            <button type="button" class="btn btn-danger" v-on:click="$emit('delete-currency', currency)" v-if="!edit">
                Delete
            </button>
        </td>
    </tr>
</template>

<script>
    export default {
        props:['currency'],
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
            editCurrency(){
                this.edit = true;
                this.editForm.name = this.currency.name;
                this.editForm.description = this.currency.description;
            },
            cancelEdit(){
                this.edit = false;
                this.editForm.name = '';
                this.editForm.description = '';
            },
            updateCurrency(oldCurrency, newCurrency){
                this.$http.patch('/admin/currency/update/' + oldCurrency.id, newCurrency).then(response => {
                    this.$emit('update-currency');
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

