@extends('layouts.app')

@section('content')



    <div class="container">


        <h1>Courses</h1>
        <div class="col-md-12">
            <div class="row">
                <hr>


                    @foreach($course as $co)
                    <a href="plan">
                        <div class="panel panel-warning">
                            @if($co->plans->id != 1)
                                <img class="latte-course-upgrade" src="{{ asset('images/star.png') }}" height="720" alt="AW" width="720"/>
                            @endif
                            <div class="panel-heading">{{ $co->name }} <strong class="pull-right">{{ $co->plans->name }}</strong></div>

                            <div class="panel-body">{{ $co->description  }}</div>

                        </div>
                    </a>
                    @endforeach

            </div>
        </div>
    </div>


    @include('includes.data-stuff')

    @include('includes.trial-stuff')

    @include('includes.footer')
@endsection


