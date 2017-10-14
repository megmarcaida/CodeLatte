@extends('layouts.app')

@section('content')

    <div class="container">

        <div class="row">

            <div class="col-xs-12 col-md-12 col-lg-12">
                <div class="bg-bill-error">
                    You have an overdue payment, so you don't currently have full access to our learning material. If you're ready to start learning again,
                    <a href=""> click here to update your payment method.</a>
                </div>

                <a class="latte-hover btn-lg" href="/users/curriculum/take/{{ $courselist->slug }}"><i class="fa fa-arrow-left" aria-hidden="true"></i> {{ $courselist->name }}</a>
                <br> <br>
                <div id="getting_started" class="panel">
                    <div class="panel-heading">
                            <button type="button" class="close" id="btnGetting_started">
                                <span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
                            </button>
                    </div>
                    <div class="panel-body">
                        <div class="col-xs-12 col-md-6 col-lg-6">
                            <h1>Getting started</h1>
                            Welcome to the {{ $courselist->name  }} Curriculum. You'll be led through a series of Tutorials and Workshops so you can efficiently master the skills you need to achieve your goals.
                            <br><br>
                            <button class="btn btn-success">Take a tour</button>
                        </div>
                        <div class="col-xs-12 col-md-6 col-lg-6">
                        </div>
                    </div>
                </div>
            </div>



            <div class="col-xs-12 col-md-6 col-lg-6">
                <div class="panel">
                    <div class="panel-body">
                        <h2>Welcome to {{ $courselist->name  }}</h2>
                        <p>{{ $courselist->description  }}</p>
                        <button class="btn bg-ebony">Switch Curriculum</button>
                    </div>
                </div>
            </div>

            <div class="col-xs-12 col-md-6 col-lg-6">
                <div class="panel">
                    <div id="curriculum" class="panel-body">
                        <strong>Curriculum</strong>
                        <h2>{{ $courselist->name  }}</h2>
                        <hr>
                        Welcome to {{ $courselist->description  }}
                    </div>
                </div>
            </div>

            <div class="col-xs-12 col-md-12 col-lg-12">

                @if (count($tutorial) > 0)

                        <div class="panel panel-success card-curriculum">
                            <div class="panel-heading bg-auburn">
                                <strong><i class="fa fa-file-code-o" aria-hidden="true"></i></strong>

                            </div>
                            <div>

                                <?php
                                switch ($tutorial->media->category){

                                case 'Image':
                                ?>
                                <img src="{{route('getmedia', $tutorial->media->filename)}}" alt="ALT NAME" class="img-responsive gal-media" />
                                <?php
                                break;
                                case 'Video':
                                ?>
                                        <video id="videoAllUrBase" controls class="img-responsive latte-video"  width="380" >
                                            <source src="{{route('usersgetmedia', $tutorial->media->filename)}}{{--#t=0,5--}}" type="video/mp4" />
                                            <p>Your browser does not support the video tag.</p>
                                        </video>
                                <?php
                                break;
                                }
                                ?>
                                <br><br>
                                    {{--
                                <input id="playButton" type="button" onclick="playVideo();" value="Play" />
                                <input id="rewButton" type="button" onclick="skip(-10);" value="Rewind" />--}}
                                    <a class="latte-hover btn-lg" href="/users/curriculum/take/{{ $courselist->slug }}"><i class="fa fa-arrow-left" aria-hidden="true"></i> {{ $courselist->name }}</a>
                                    @if (isset($quiz))
                                    <a id="vidMessage" class="pull-right latte-tutorial-next" style="display:block;" href="/users/tutorial/take/quiz/{{ $quiz->slug }}">Take quiz now to proceed to next tutorial.</a>
                                    @else
                                        <a id="vidMessage" class="pull-right latte-tutorial-next" style="display:block;" href="#">Quiz for this tutorial not yet set.</a>
                                    @endif
                            </div>
                            <div class="panel-body">

                                <hr>
                                <p>{{ $tutorial->description }}</p>
                                <a href="#"><span class="tag label label-info">{{ $tutorial->programminglanguage->name }}</span></a>
                                <a href="#"><span class="tag label label-info">{{ $courselist->plans->name }}</span></a>
                            </div>
                        </div>

                @endif
            </div>

        </div>

        @include('users.footer')

    </div>
@endsection
