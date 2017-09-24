<template>

    <div>
        <div class="col-xs-12 col-md-4 col-lg-4">
            <div class="panel">
                <div class="panel-heading">
                    <h4 class="panel-title">Add Media</h4>
                </div>
                <div class="panel-body">

                    <form v-on:submit.prevent="createMedia" method="post" enctype="multipart/form-data">

                        <div v-bind:class="{'form-group': true, 'has-error': errors.filename}">
                            <label>Image:</label>
                            <div>
                                <input type="text" v-model="media.filename">
                                <input type="file" @change="onFileChange">
                            </div>
                            <span class="help-block" v-for="error in errors.filename">{{ error }}</span>
                        </div>

                        <div v-bind:class="{'form-group': true, 'has-error': errors.description}">
                            <label>Description:</label>
                            <input type="text" v-model="media.description" class="form-control">
                            <span class="help-block" v-for="error in errors.description">{{ error }}</span>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Add New Media</button>
                        </div>

                    </form>
                </div>
            </div><!-- panel -->
        </div> <!-- col -->

        <div class="col-xs-12 col-md-8 col-lg-8">
            <div class="panel">
                <div class="panel-heading">
                    <h4 class="panel-title">Media List</h4>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>File Name</th>
                                <th>Description</th>
                                <th>Action</th>
                            </tr>
                            </thead>

                            <tbody>
                            <Media v-for="media in medias" :key="media.id"  v-bind:media="media" v-on:delete-media="deleteMedia" v-on:update-media="fetchMedia">
                            </Media>
                            </tbody>
                        </table>

                        <!-- Pagination -->
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

                    </div><!-- table-responsive -->
                </div>
            </div><!-- panel -->
        </div>

    </div>
</template>

<script>
    import Media from './Media.vue';
    export default {
        data(){
            return {
                medias: [],
                errors: [],
                media:{
                    filename: '',
                    description: ''
                },
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
        components:{ Media },
        created(){
            this.fetchMedia(this.pagination.current_page);

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
            fetchMedia: function(page){
                this.$http.get('/admin/media/list?page='+page).then(response => {
                    this.medias  = response.data.media.media.data;
                    this.pagination = response.data.media.pagination;
                    console.log(this.medias);
                });
            },
            createMedia(){
                this.$http.post('/admin/media/add', this.media).then(response => {
                    this.changePage(this.pagination.current_page);
                    this.media = {filename: '', description:''};

                    if (this.errors) {
                        this.errors = [];
                    }
                    console.log(response.data);

                }, response => {
                    this.errors = response.data;
                });
            },
            deleteMedia(media){
                this.$http.delete('/admin/media/delete/' + media.id).then(response => {
                    this.changePage(this.pagination.current_page);
                    let index = this.medias.indexOf(media);
                    this.medias.splice(index, 1);
                    console.log(response.data);
                });
            },

            changePage: function (page) {
                this.pagination.current_page = page;
                this.fetchMedia(page);
            },
            onFileChange(e) {
                var files = e.target.files || e.dataTransfer.files;
                if (!files.length)
                    return;
                this.media.filename = files[0].name;
               console.log(files[0]);
            },
            removeImage: function (e) {
                this.image = '';
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