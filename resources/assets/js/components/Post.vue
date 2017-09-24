<template>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">


                    <div class="panel-body">
                        <textarea rows="3" class="form-control" v-model="content"></textarea>
                        <br>
                        <button class="btn btn-success pull-right" :disabled="not_working" @click="create_post()">
                            Share your thoughts...
                        </button>

                    </div>
                </div>
            </div>
        </div>
    </div>
</template>


<script>
    import Feed from './Feed.vue'
    export default {
        mounted(){

        },
        data(){
            return{
                content:'',
                not_working: true
            }
        },
        methods:{
            create_post(){
                this.$http.post('/create/post', { content: this.content })
                    .then((resp) => {
                        this.content = ''

                        $(document).ready(function(){
                            var n = new Noty({
                                type: 'success',
                                layout: 'bottomLeft',
                                text: 'Thoughts has been shared.',
                            }).show();
                            n.setTimeout(2000);
                        });
                        document.getElementById("noty_audio").play()
                        $("#feed").load(
                        setTimeout(function(){
                            location.reload(1);
                        }, 3000));
                    })
            }
        },
        watch:{
            content(){
                if(this.content.length > 0)
                    this.not_working = false
                else
                    this.not_working = true
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