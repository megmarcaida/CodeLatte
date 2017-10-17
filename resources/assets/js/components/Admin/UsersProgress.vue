<template>

    <div class="col-xs-12 col-md-12 col-lg-12">

        <div class="userslists">


            <div class="panel panel-default">
                <div class="panel-heading">
                    <strong>List of Course</strong>
                </div>
                <div class="panel-body">
                    <div class="table table-responsive">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>Quiz Name</th>
                                <th>Quiz Description</th>
                                <th>Score</th>
                                <th>Avatar</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Email</th>
                                <th>Username</th>
                                <th>Status</th>
                            </tr>
                            </thead>
                            <tbody v-for="uqa in usersquizanswer">
                            <tr>

                                <td>{{ uqa.quiz.name }}</td>
                                <td>{{ uqa.quiz.description }}</td>
                                <td>{{ uqa.score }}/{{ uqa.items }}</td>
                                <td><img width="30px" height="30px" :src="uqa.users.avatar" alt=""></td>
                                <td>{{ uqa.users.firstname }}</td>
                                <td>{{ uqa.users.lastname }}</td>
                                <td>{{ uqa.users.email }}</td>
                                <td>{{ uqa.users.username }}</td>
                                <td>{{ uqa.quiz_status == 1 ? 'Passed' : 'Failed' }}</td>
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
                usersquizanswer: [],
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
            this.fetchUsersCourse(this.pagination.current_page);

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
            fetchUsersQuizAnswer: function(page){
                this.$http.get('/admin/progress/list?page='+page).then(response => {
                    this.usersquizanswer  = response.data.usersquizanswer.usersquizanswer.data;
                    this.pagination = response.data.usersquizanswer.pagination;
                    console.log(response.data)
                });
            },
            changePage: function (page) {
                this.pagination.current_page = page;
                this.fetchUsersQuizAnswer(page);
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