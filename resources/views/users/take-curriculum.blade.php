@extends('layouts.app')

@section('content')

    <div class="container">

        <div class="row">

            <div class="col-xs-12 col-md-12 col-lg-12">
                <div class="bg-bill-error">
                    You have an overdue payment, so you don't currently have full access to our learning material. If you're ready to start learning again,
                    <a href=""> click here to update your payment method.</a>
                </div>

                <div class="panel">
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

                @if (count($tutorials) > 0)
                    @foreach($tutorials as $tutorial)

                            <div class="panel panel-success card-curriculum">
                                <div class="panel-heading bg-turquoise">
                                    <strong><i class="fa fa-file-code-o" aria-hidden="true"></i></strong>
                                    <a href="" data-toggle="tooltip" title="Watch Trailer" class="pull-right"><i class="fa fa-play-circle-o" aria-hidden="true"></i></a>
                                    <a href="" data-toggle="tooltip" title="Bookmark" class="pull-right"><i class="fa fa-bookmark" aria-hidden="true"></i>&nbsp;</a>
                                </div>
                                <div class="panel-body">
                                   <strong>Tutorial</strong>
                                    <br>
                                    <a href="/users/library/{{$courselist->slug}}/{{ $tutorial->slug }}"><strong>{{ $tutorial->name }}</strong></a>
                                    <hr>
                                    <p>{{ $tutorial->description }}</p>
                                </div>
                            </div>

                    @endforeach
                @endif
            </div>

        </div>

        @include('users.footer')

    </div>
@endsection
