<template>
    <div>

    </div>
</template>

<script>
    export default{
        mounted(){
             this.listen()
        },
        props: ['id'],
        methods:{
            listen(){
                Echo.private('App.User.' + this.id)
                    .notification( (notification) => {
                        $(document).ready(function(){
                            var n = new Noty({
                                type: 'success',
                                layout: 'bottomLeft',
                                text: notification.username + ' ' + notification.message,
                            }).show();
                            n.setTimeout(1000);
                        })

                        this.$store.commit('add_not',notification)

                        document.getElementById("noty_audio").play()
                    })
            }
        }
    }
</script>