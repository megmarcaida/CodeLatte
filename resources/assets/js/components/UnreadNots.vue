<template>

    <li>
        <a href="/notifications">
            <span class="fa-stack has-badge span-count" v-bind:data-count="all_nots_count">
              <i class="fa fa-bell fa-stack-1x not-bell"></i>
            </span>

            <!--<span class="badge">{{ all_nots_count }}</span>
            <span class="glyphicon glyphicon-bell"></span>-->
        </a>
    </li>

</template>

<script>
    export default{
        mounted(){
            this.get_unread()
        },
        methods:{
            get_unread(){
                this.$http.get('/get_unread')
                    .then((nots) => {
                        nots.body.forEach( (not) =>{
                            this.$store.commit('add_not', not)

                        })
                        console.log(nots)
                    })
            }
        },
        computed: {
            all_nots_count(){
                return this.$store.getters.all_nots_count
            }
        }
    }
</script>