@extends('admin.layouts.app')

@section('content')
    <div class="mainpanel">

        <div class="contentpanel">

            <ol class="breadcrumb breadcrumb-quirk">
                <li><a href="/admin/home"><i class="fa fa-home mr5"></i> Home</a></li>
                <li class="active">Media</li>
            </ol>

            <!-- Modal -->
            <div id="mediaEdit" class="modal fade" role="dialog">
                <div class="modal-dialog">

                    <!-- Modal content-->
                    <form action="{{route('updatemedia', [])}}" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">Edit Media</h4>
                            </div>
                            <div class="modal-body">


                                    <div class="form-group">
                                        <input type="hidden" name="mediaID" id="mediaID">
                                    </div>
                                    <div class="form-group">
                                        <label for="title">Title :</label>
                                        <input required type="text" id="title" class="form-control" name="title">
                                    </div>
                                    <div class="form-group ">
                                        <label for="description">Description:</label>
                                        <input required type="text" id="description" class="form-control" name="description">
                                    </div>

                                    <div class="form-group">
                                        <label for="email">&nbsp;</label>
                                        <input class="btn btn-primary form-control" type="submit">
                                    </div>


                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>

            <div class="col-md-12 ">
                <div class="panel panel-default">
                    <div class="panel-heading"> <h4> Add Media </h4> </div>

                    <div class="panel-body">
                        <form action="{{route('addmedia', [])}}" method="post" enctype="multipart/form-data">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                                <div class="form-group col-xs-12 col-md-6 col-lg-6">
                                    <label for="title">Title :</label>
                                    <input required type="text" class="form-control" name="title">
                                </div>
                                <div class="form-group col-xs-12 col-md-6 col-lg-6">
                                    <label for="description">Description:</label>
                                    <input required type="text" class="form-control" name="description">
                                </div>

                                <div class="form-group col-xs-12 col-md-10 col-lg-10">
                                    <label for="media">Upload Media:</label>
                                    <input required type="file" class="form-control" accept="video/*|image/*" name="media">
                                </div>

                                <div class="form-group col-xs-12 col-md-2 col-lg-2">
                                    <label for="email">&nbsp;</label>
                                    <input class="btn btn-primary form-control" type="submit">
                                </div>

                            <br>
                        </form>

                        <div class="row">
                            <div class="col-xs-12 col-md-12 col-lg-12">

                                <ul class="thumbnails">
                                    @foreach($media as $med)
                                        <div class="col-xs-4 col-md-2">
                                            <div class="thumbnail media-thumb">
                                                <?php
                                                switch ($med->category){

                                                    case 'Image':
                                                ?>
                                                    <img src="{{route('getmedia', $med->filename)}}" alt="ALT NAME" class="img-responsive gal-media" />
                                                <?php
                                                    break;
                                                    case 'Video':
                                                ?>
                                                    <video id="video_{{ $med->id }}" class="gal-media" controls>
                                                        <source src={{route('getmedia', $med->filename)}} type="video/mp4">
                                                    </video>
                                                <?php
                                                    break;
                                                }
                                                ?>

                                                <div class="caption">
                                                    <div class="break-word">{{$med->title}}</div>
                                                    <div class="break-word">{{$med->description}}</div>
                                                    <!-- Trigger the modal with a button -->
                                                    <a class="btn btn-success btn-xs" id="openMedia" data-id="{{ $med->id }}" href="#" type="button" data-title="{{ $med->title }}" data-description="{{ $med->description }}"  data-toggle="modal" data-target="#mediaEdit">Edit Info</a>
                                                    <a href="{{ url('/admin/media/delete/'. $med->id ) }}" class="btn btn-danger btn-xs" id="openMedia" data-id="{{ $med->id }}"  href="#" type="button" >Delete</a>
                                                    <button id="videoBtn_{{ $med->id }}" class="btn btn-success btn-xs">Set</button>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </ul>
                                <?php echo $media->render(); ?>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div><!-- contentpanel -->
    </div><!-- mainpanel -->

@endsection
