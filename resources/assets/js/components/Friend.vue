<template>
    <div>
            <p class="text-center" v-if="loading">
                Loading...
            </p>
            <p class="text-center" v-if="!loading">
                <button class="btn btn-success" v-if="status == 'friends'" @click="unfriend_friend">Unfriend</button>
                <button class="btn btn-success" v-if="status == 0" @click="add_friend">Add Friend</button>
                <button class="btn btn-success" v-if="status == 'pending'" @click="accept_friend">Accept Friend</button>
                <span class="text-success" v-if="status == 'waiting'">Waiting for Responses</span>
                <span class="text-success" v-if="status == 'friends'">Friends</span>
            </p>
    </div>
</template>

<script>
    export default {
        mounted() {
            this.$http.get('/check_relationship_status/' + this.profile_user_id)
            .then((resp) => {
                console.log(resp)
                this.status = resp.body.status
                this.loading = false
            })
        },
        props: ['profile_user_id'],
        data(){
            return{
                status: '',
                loading: true
            }
        },
        methods:{
            add_friend(){
                this.loading = true
                this.$http.get('/add_friend/'+ this.profile_user_id )
                    .then( (resp) => {
                        if (resp.body == 1)
                            this.status = 'waiting'
                        $(document).ready(function(){
                            var n = new Noty({
                                type: 'success',
                                layout: 'bottomLeft',
                                text: 'Friend Request Sent.',
                                animation: {
                                    open: function (promise) {
                                        var n = this;
                                        var Timeline = new mojs.Timeline();
                                        var body = new mojs.Html({
                                            el        : n.barDom,
                                            x         : {500: 0, delay: 0, duration: 500, easing: 'elastic.out'},
                                            isForce3d : true,
                                            onComplete: function () {
                                                promise(function(resolve) {
                                                    resolve();
                                                })
                                            }
                                        });

                                        var parent = new mojs.Shape({
                                            parent: n.barDom,
                                            width      : 200,
                                            height     : n.barDom.getBoundingClientRect().height,
                                            radius     : 0,
                                            x          : {[150]: -150},
                                            duration   : 1.2 * 500,
                                            isShowStart: true
                                        });

                                        n.barDom.style['overflow'] = 'visible';
                                        parent.el.style['overflow'] = 'hidden';

                                        var burst = new mojs.Burst({
                                            parent  : parent.el,
                                            count   : 10,
                                            top     : n.barDom.getBoundingClientRect().height + 75,
                                            degree  : 90,
                                            radius  : 75,
                                            angle   : {[-90]: 40},
                                            children: {
                                                fill     : '#EBD761',
                                                delay    : 'stagger(500, -50)',
                                                radius   : 'rand(8, 25)',
                                                direction: -1,
                                                isSwirl  : true
                                            }
                                        });

                                        var fadeBurst = new mojs.Burst({
                                            parent  : parent.el,
                                            count   : 2,
                                            degree  : 0,
                                            angle   : 75,
                                            radius  : {0: 100},
                                            top     : '90%',
                                            children: {
                                                fill     : '#EBD761',
                                                pathScalfe: [.65, 1],
                                                radius   : 'rand(12, 15)',
                                                direction: [-1, 1],
                                                delay    : .8 * 500,
                                                isSwirl  : true
                                            }
                                        });

                                        Timeline.add(body, burst, fadeBurst, parent);
                                        Timeline.play();
                                    },
                                    close: function (promise) {
                                        var n = this;
                                        new mojs.Html({
                                            el        : n.barDom,
                                            x         : {0: 500, delay: 10, duration: 500, easing: 'cubic.out'},
                                            skewY     : {0: 10, delay: 10, duration: 500, easing: 'cubic.out'},
                                            isForce3d : true,
                                            onComplete: function () {
                                                promise(function(resolve) {
                                                    resolve();
                                                })
                                            }
                                        }).play();
                                    }
                                }
                            }).show();
                            n.setTimeout(1000);
                        });
                        this.loading = false
                    })
            },
            accept_friend(){
                this.loading = true
                this.$http.get('/accept_friend/'+ this.profile_user_id )
                    .then( (resp) => {
                        if (resp.body == 1)
                            this.status = 'friends'
                        $(document).ready(function(){
                            var n = new Noty({
                                type: 'success',
                                layout: 'bottomLeft',
                                text: 'You are now friend.',
                                animation: {
                                    open: function (promise) {
                                        var n = this;
                                        var Timeline = new mojs.Timeline();
                                        var body = new mojs.Html({
                                            el        : n.barDom,
                                            x         : {500: 0, delay: 0, duration: 500, easing: 'elastic.out'},
                                            isForce3d : true,
                                            onComplete: function () {
                                                promise(function(resolve) {
                                                    resolve();
                                                })
                                            }
                                        });

                                        var parent = new mojs.Shape({
                                            parent: n.barDom,
                                            width      : 200,
                                            height     : n.barDom.getBoundingClientRect().height,
                                            radius     : 0,
                                            x          : {[150]: -150},
                                            duration   : 1.2 * 500,
                                            isShowStart: true
                                        });

                                        n.barDom.style['overflow'] = 'visible';
                                        parent.el.style['overflow'] = 'hidden';

                                        var burst = new mojs.Burst({
                                            parent  : parent.el,
                                            count   : 10,
                                            top     : n.barDom.getBoundingClientRect().height + 75,
                                            degree  : 90,
                                            radius  : 75,
                                            angle   : {[-90]: 40},
                                            children: {
                                                fill     : '#EBD761',
                                                delay    : 'stagger(500, -50)',
                                                radius   : 'rand(8, 25)',
                                                direction: -1,
                                                isSwirl  : true
                                            }
                                        });

                                        var fadeBurst = new mojs.Burst({
                                            parent  : parent.el,
                                            count   : 2,
                                            degree  : 0,
                                            angle   : 75,
                                            radius  : {0: 100},
                                            top     : '90%',
                                            children: {
                                                fill     : '#EBD761',
                                                pathScale: [.65, 1],
                                                radius   : 'rand(12, 15)',
                                                direction: [-1, 1],
                                                delay    : .8 * 500,
                                                isSwirl  : true
                                            }
                                        });

                                        Timeline.add(body, burst, fadeBurst, parent);
                                        Timeline.play();
                                    },
                                    close: function (promise) {
                                        var n = this;
                                        new mojs.Html({
                                            el        : n.barDom,
                                            x         : {0: 500, delay: 10, duration: 500, easing: 'cubic.out'},
                                            skewY     : {0: 10, delay: 10, duration: 500, easing: 'cubic.out'},
                                            isForce3d : true,
                                            onComplete: function () {
                                                promise(function(resolve) {
                                                    resolve();
                                                })
                                            }
                                        }).play();
                                    }
                                }
                            }).show();
                            n.setTimeout(1000);
                        });
                        this.loading = false
                    })
            },
            unfriend_friend(){
                this.loading = true
                this.$http.get('/unfriend_friend/'+ this.profile_user_id )
                    .then( (resp) => {
                        if (resp.body == 1)
                            this.status = 0
                        $(document).ready(function(){
                            var n = new Noty({
                                type: 'success',
                                layout: 'bottomLeft',
                                text: 'Unfriended.',
                                animation: {
                                    open: function (promise) {
                                        var n = this;
                                        var Timeline = new mojs.Timeline();
                                        var body = new mojs.Html({
                                            el        : n.barDom,
                                            x         : {500: 0, delay: 0, duration: 500, easing: 'elastic.out'},
                                            isForce3d : true,
                                            onComplete: function () {
                                                promise(function(resolve) {
                                                    resolve();
                                                })
                                            }
                                        });

                                        var parent = new mojs.Shape({
                                            parent: n.barDom,
                                            width      : 200,
                                            height     : n.barDom.getBoundingClientRect().height,
                                            radius     : 0,
                                            x          : {[150]: -150},
                                            duration   : 1.2 * 500,
                                            isShowStart: true
                                        });

                                        n.barDom.style['overflow'] = 'visible';
                                        parent.el.style['overflow'] = 'hidden';

                                        var burst = new mojs.Burst({
                                            parent  : parent.el,
                                            count   : 10,
                                            top     : n.barDom.getBoundingClientRect().height + 75,
                                            degree  : 90,
                                            radius  : 75,
                                            angle   : {[-90]: 40},
                                            children: {
                                                fill     : '#EBD761',
                                                delay    : 'stagger(500, -50)',
                                                radius   : 'rand(8, 25)',
                                                direction: -1,
                                                isSwirl  : true
                                            }
                                        });

                                        var fadeBurst = new mojs.Burst({
                                            parent  : parent.el,
                                            count   : 2,
                                            degree  : 0,
                                            angle   : 75,
                                            radius  : {0: 100},
                                            top     : '90%',
                                            children: {
                                                fill     : '#EBD761',
                                                pathScalfe: [.65, 1],
                                                radius   : 'rand(12, 15)',
                                                direction: [-1, 1],
                                                delay    : .8 * 500,
                                                isSwirl  : true
                                            }
                                        });

                                        Timeline.add(body, burst, fadeBurst, parent);
                                        Timeline.play();
                                    },
                                    close: function (promise) {
                                        var n = this;
                                        new mojs.Html({
                                            el        : n.barDom,
                                            x         : {0: 500, delay: 10, duration: 500, easing: 'cubic.out'},
                                            skewY     : {0: 10, delay: 10, duration: 500, easing: 'cubic.out'},
                                            isForce3d : true,
                                            onComplete: function () {
                                                promise(function(resolve) {
                                                    resolve();
                                                })
                                            }
                                        }).play();
                                    }
                                }
                            }).show();
                            n.setTimeout(1000);
                        });
                        this.loading = false
                    })
            }
        }
    }
</script>
