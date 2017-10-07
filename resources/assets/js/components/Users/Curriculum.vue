<template>

    <div class="col-xs-12 col-md-12 col-lg-12">
            <div class="panel panel-primary"  v-for="curriculum in curriculums" >
                <div class="panel-heading">{{ curriculum.name }}</div>
                <div class="panel-body">
                    {{ curriculum.description }}
                </div>
            </div>


            <nav>
                <ul class="pagination">
                    <li v-if="pagination.current_page > 1">
                        <a href="#" aria-label="Previous"
                           @click.prevent="changePage(pagination.current_page - 1)">
                            <span aria-hidden="true">«</span>
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
                            <span aria-hidden="true">»</span>
                        </a>
                    </li>
                </ul>
            </nav>
    </div>
</template>

<script>
    export default {
        data(){
            return {
                curriculums: [],
                plans : [],
                errors: [],
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
            this.fetchCurriculum(this.pagination.current_page);
            //this.fetchPlans();
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
            fetchCurriculum: function(page){
                this.$http.get('/users/curriculum/list?page='+page).then(response => {
                    this.curriculums  = response.data.curriculums.curriculums.data;
                    this.pagination = response.data.curriculums.pagination;


                });
            },
            fetchPlans(){
                /*this.$http.get('/admin/quiz/list').then(response => {
                    this.quizzes = response.data.quiz.quiz.data;


                });*/
            },

            changePage: function (page) {
                this.pagination.current_page = page;
                this.fetchCurriculum(page);
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