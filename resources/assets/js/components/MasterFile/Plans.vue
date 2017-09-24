<template>




    <tr>
        <td>
            <div class="form-group">
                <input type="text" id="name" class="form-control" v-model="editForm.name" v-if="edit">
                <span v-else>{{ plan.name }}</span>
            </div>
        </td>
        <td>
            <div class="form-group">
                <input type="number" class="form-control" id="price"  v-model="editForm.price" v-if="edit">
                <span v-else>{{ plan.price }}</span>
            </div>
        </td>
        <td>
            <div class="form-group">
                <input type="number" class="form-control" id="discount"  v-model="editForm.discount" v-if="edit">
                <span v-else>{{ plan.discount }}</span>
            </div>
        </td>
        <td>
            <button type="button" class="btn btn-info" v-on:click="editPlan" v-if="!edit">
                Edit
            </button>

            <button type="button" class="btn btn-default" v-on:click="cancelEdit" v-if="edit">
                Cancel
            </button>

            <button type="button" class="btn btn-primary" v-on:click="updatePlan(plan, editForm)" v-if="edit">
                update
            </button>
            <button type="button" class="btn btn-danger" v-on:click="$emit('delete-plan', plan)" v-if="!edit">
                Delete
            </button>
        </td>
    </tr>
</template>

<script>
    export default {
        props:['plan'],
        data(){
            return {
                edit: false,
                editForm :{
                    name: '',
                    price: '',
                    discount: ''
                }
            }
        },
        methods: {
            editPlan(){
                this.edit = true;
                this.editForm.name = this.plan.name;
                this.editForm.price = this.plan.price;
                thiss.editForm.discount = this.plan.discount;
            },
            cancelEdit(){
                this.edit = false;
                this.editForm.name = '';
                this.editForm.price = '';
                this.editForm.discount = '';
            },
            updatePlan(oldPlan, newPlan){
                this.$http.patch('/admin/plans/update/' + oldPlan.id, newPlan).then(response => {
                    this.$emit('update-plan');
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

