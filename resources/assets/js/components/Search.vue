<template>
    <li style="width: 280px;margin: 0 auto;">
        <input style="margin:1em auto;" type="text" class="input-sm form-control" placeholder="Search users..." @keyup.esc="empty" v-model="query" @keyup.enter="search">

        <div class="dropdown">
            <ul class="search-list" style="position:absolute;top:0;left:0;" v-if="results.length">
                <li class="text-center" v-for="user in results">
                    <a :href="'/profile/'+ user.slug">
                        <img :src="user.avatar" alt="" width="25px" height="25px" class="searched-user">
                        <h6 class="text-center">{{ user.firstname + ' ' + user.lastname }}</h6>
                    </a>
                </li>
            </ul>
        </div>
    </li>
</template>


<script>

    var algoliasearch = require('algoliasearch')

    var client = algoliasearch('QBV1CSOPU6','07c03237ff230f6d88a7a67c2b247002');

    var index = client.initIndex('users')

    export default{
        mounted(){

        },
        data(){
            return{
                query: '',
                results:[]
            }
        },
        methods:{
            search(){
                index.search(this.query, (err, content) => {
                    this.results = content.hits
                    /*console.log(content.hits)*/
                })
            },

            empty(){
                index.search(this.query, (err, content) => {
                    this.results = 0;
                    /*console.log(content.hits)*/
                })
            }
        }
    }
</script>

<style>
    .searched-user{
        border-radius:50%;
    }
</style>