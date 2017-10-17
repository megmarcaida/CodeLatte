<template>

    <div class="col-xs-12 col-md-12 col-lg-12">

        <div class="billinginfo" v-for="(billing,index) in billinginfo">


            <div class=" panel-warning">
                <div class="panel-heading">
                    <i class="fa fa-book" aria-hidden="true"></i>&nbsp;&nbsp;
                    <h5 data-toggle="tooltip" title="Continue this course." class="pull-right"><i class="fa fa-bookmark" aria-hidden="true"></i>&nbsp;Pending</h5>
                </div>
                <div class="panel-body">

                </div>
                <div class="panel-footer card-curriculum-footer">
                    <a href="#" data-toggle="tooltip"  title="$80,000/yr"><i class="fa fa-university" aria-hidden="true"></i></a>
                    <a href="" data-toggle="tooltip" title="Watch Trailer"><i class="fa fa-play-circle-o" aria-hidden="true"></i></a>
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