<template>
    <div class="">

        <hr>

        <p class="text-center displayInlineBlock" v-for="like in post.likes">
            <img :src="like.user.avatar" width="15px" height="15px" class="avatar-like">
        </p>

        <hr>

        <button class="btn btn-xs btn-primary" v-if="!auth_user_likes_post" @click="like()">
            Satisfied
        </button>

        <button class="btn btn-xs btn-danger" v-else @click="unlike()">
            Unsatisfied
        </button>

    </div>
</template>

<script>
    export default {
        mounted(){

        },
        props: ['id'],
        computed:{
            likers(){
                var likers = []

                this.post.likes.forEach( (like) => {
                    likers.push(like.user.id)
                })

                return likers
            },
            auth_user_likes_post(){
                var check_index = this.likers.indexOf(
                    this.$store.state.auth_user.id
                )

                if (check_index === -1)
                    return false
                else
                    return true
            },
            post(){
                return this.$store.state.posts.find( (post) => {
                    return post.id === this.id
                })
            }
        },
        methods:{
            like(){
                this.$http.get('/like/' + this.id)
                    .then((resp)=>{
                        this.$store.commit('update_post_likes', {
                            id: this.id,
                            like: resp.body
                        })

                        $(document).ready(function(){
                            var n = new Noty({
                                type: 'success',
                                layout: 'bottomLeft',
                                text: 'You are satisfied!',
                            }).show();
                            n.setTimeout(3000);
                        })
                    })
            },
            unlike(){
                this.$http.get('/unlike/' + this.id)
                    .then((resp) => {
                        this.$store.commit('unlike_post',{
                            post_id: this.id,
                            like_id: resp.body
                        })

                        $(document).ready(function(){
                            var n = new Noty({
                                type: 'success',
                                layout: 'bottomLeft',
                                text: 'You are unsatisfied!',
                            }).show();
                            n.setTimeout(3000);
                        })
                    })
            }
        }

    }
</script>

<style>
    .avatar-like{
        -webkit-border-radius:50%;
        -moz-border-radius:50%;
        border-radius:50%;
    }
</style>