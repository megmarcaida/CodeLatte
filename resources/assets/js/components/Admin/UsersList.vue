<template>

    <div class="col-xs-12 col-md-12 col-lg-12">

        <div class="userslists">


            <div class="panel panel-default">
                <div class="panel-heading">
                    <strong>List of Users</strong>
                </div>
                <div class="panel-body">
                    <div class="table table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Avatar</th>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Email</th>
                                    <th>Username</th>
                                    <th>Plan</th>
                                </tr>
                            </thead>
                            <tbody v-for="userslist in userslists">
                                <tr>
                                    <td><img width="30px" height="30px" :src="userslist.users.avatar" alt=""></td>
                                    <td>{{ userslist.users.firstname }}</td>
                                    <td>{{ userslist.users.lastname }}</td>
                                    <td>{{ userslist.users.email }}</td>
                                    <td>{{ userslist.users.username }}</td>
                                    <td>{{ userslist.plans.name }}</td>
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
                userslists: [],
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
            this.fetchUsersList(this.pagination.current_page);

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
            fetchUsersList: function(page){
                this.$http.get('/admin/users/list?page='+page).then(response => {
                    this.userslists  = response.data.userslist.userslist.data;
                     this.pagination = response.data.userslist.pagination;

                });
            },
            changePage: function (page) {
                this.pagination.current_page = page;
                this.fetchUsersList(page);
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