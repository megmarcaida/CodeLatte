<template>




    <tr>
        <td>
            <div class="form-group">
                <input type="text" id="name" class="form-control" v-model="editForm.name" v-if="edit">
                <span v-else>{{ planscontent.name }}</span>
            </div>
        </td>
        <td>
            <div class="form-group">
                <input type="text" class="form-control" id="price"  v-model="editForm.description" v-if="edit">
                <span v-else>{{ planscontent.description }}</span>
            </div>
        </td>
        <td>
            <div class="form-group">
                <!--<input type="text" class="form-control" id="discount"  v-model="editForm.plans_id" v-if="edit">-->
                <select class="form-control" id="plans_id"  v-model="editForm.plans_id" v-if="edit">
                    <option v-bind:value="plan.id"  v-for="plan in plans">
                        {{ plan.name }}
                    </option>
                </select>
                <span v-else>{{ planscontent.plans.name }}</span>
            </div>
        </td>
        <td>
            <button type="button" class="btn btn-info" v-on:click="editPlansContent" v-if="!edit">
                Edit
            </button>

            <button type="button" class="btn btn-default" v-on:click="cancelEdit" v-if="edit">
                Cancel
            </button>

            <button type="button" class="btn btn-primary" v-on:click="updatePlansContent(planscontent, editForm)" v-if="edit">
                update
            </button>
            <button type="button" class="btn btn-danger" v-on:click="$emit('delete-planscontent', planscontent)" v-if="!edit">
                Delete
            </button>
        </td>
    </tr>
</template>

<script>
    export default {
        props:['planscontent'],
        data(){
            return {
                plans: [],
                edit: false,
                editForm :{
                    name: '',
                    description: '',
                    plans_id: ''
                }
            }
        },
        created(){
            this.fetchPlans();
        }
        ,
        methods: {
            editPlansContent(){
                this.edit = true;
                this.editForm.name = this.planscontent.name;
                this.editForm.description = this.planscontent.description;
                this.editForm.plans_id = this.planscontent.plans_id;
            },
            cancelEdit(){
                this.edit = false;
                this.editForm.name = '';
                this.editForm.description = '';
                this.editForm.plans_id = '';
            },
            updatePlansContent(oldPlansContent, newPlansContent){
                this.$http.patch('/admin/plans-content/update/' + oldPlansContent.id, newPlansContent).then(response => {
                    this.$emit('update-planscontent');
                    this.cancelEdit();
                }, (response) => {
                });
            },
            fetchPlans(){
                this.$http.get('/admin/plans/list').then(response => {
                    this.plans = response.data.plans.plan.data;;


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

