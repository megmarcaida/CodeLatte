<template>

    <div class="col-xs-12 col-md-12 col-lg-12">

        <div class="billinginfo">


            <div class="panel panel-default">
                <div class="panel-heading">
                    <strong>List of  Billing Informations</strong>
                </div>
                <div class="panel-body">
                    <div class="table table-responsive">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>Availed Plan</th>
                                <th>Billing Address</th>
                                <th>Billing Contact</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Email</th>
                                <th>Billing Method</th>
                                <th>Billing Cost</th>
                                <th>Billing Due Date</th>
                                <th>Card Brand</th>
                                <th>Card Last Four Digit</th>
                            </tr>
                            </thead>
                            <tbody v-for="billing in billinginfo">
                            <tr>
                                <th>{{ billing.billing_name }}</th>
                                <td>{{ billing.billing_address }}</td>
                                <td>{{ billing.billing_contact }}</td>
                                <td>{{ billing.users.firstname }}</td>
                                <td>{{ billing.users.lastname }}</td>
                                <td>{{ billing.users.email }}</td>
                                <td>{{ billing.billing_method }}</td>
                                <td>$ {{ billing.plans.cost }}</td>
                                <td>{{ billing.billing_duedate }}</td>
                                <td>{{ billing.users.card_brand }}</td>
                                <td>**** **** **** {{ billing.users.card_last_four }}</td>

                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="panel-footer card-curriculum-footer">

                </div>
            </div>

            <nav>
                <ul class="pagination">
                    <li v-if="pagination.current_page > 1">
                        <a href="#" aria-label="Previous"
                           @click.prevent="changePage(pagination.current_page - 1)">
                            <span aria-hidden="true">?</span>
                        </a>
                    </li>
                    <li v-for="page in pagesNumber"
                        v-bind:class="[ page == isActived ? 'active' : '']">
                        <a href="#"
                           @click.prevent="changePage(page)">{{ page }}</a>
                    </li>
                    <li v-if="pagination.current_page < pagination.last_page">
                        <a href="#" aria-label="Next"
                           @click.prevent="changePage(pagination.current_page + 1)">
                            <span aria-hidden="true">?</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</template>
<script>
    export default {
        data(){
            return {
                errors: [],
                billinginfo: [],
                pagination: {
                    total: 0,
                    per_page: 2,
                    from: 1,
                    to: 0,
                    current_page: 1
                },
                offset: 4,
            }
        },
        created(){
            this.fetchUsersBillingInfo(this.pagination.current_page);

        },
        computed: {
            isActived: function () {
                return this.pagination.current_page;
            },
            pagesNumber: function () {
                if (!this.pagination.to) {
                    return [];
                }
                var from = this.pagination.current_page - this.offset;
                if (from < 1) {
                    from = 1;
                }
                var to = from + (this.offset * 2);
                if (to >= this.pagination.last_page) {
                    to = this.pagination.last_page;
                }
                var pagesArray = [];
                while (from <= to) {
                    pagesArray.push(from);
                    from++;
                }
                return pagesArray;
            }
        },
        methods: {
            fetchUsersBillingInfo: function(page){
                this.$http.get('/admin/billinginfo/list?page='+page).then(response => {
                    this.billinginfo  = response.data.billinginfo.billinginfo.data;
                    this.pagination = response.data.billinginfo.pagination;
                    console.log(response.data.billinginfo.billinginfo);
                });
            },
            changePage: function (page) {
                this.pagination.current_page = page;
                this.fetchUsersBillingInfo(page);
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


<style>
    .avatar-feed{
        border-radius:50%;
    }
</style>