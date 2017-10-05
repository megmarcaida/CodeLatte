<template>
    <li>
        <input style="margin-top:1em;" type="text" class="input-sm form-control" placeholder="Search users..." v-model="query" @keyup.enter="search">

        <div class="row" v-if="results.length">
            <div class="text-center" v-for="user in results">
                <a :href="'/profile/'+ user.slug">
                    <img :src="user.avatar" alt="" width="50px" height="50px" class="searched-user">
                    <h4 class="text-center">{{ user.name }}</h4>
                </a>

            </div>
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
            }
        }
    }
</script>

<style>
    .searched-user{
        border-radius:50%;
    }
</style>