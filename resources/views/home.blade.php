@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="col-xs-12 col-md-3 col-lg-3">
        <ul class="home-sidebar">
            <li><a data-toggle="tooltip" href="{{ route('profile',['slug'=> Auth::user()->slug ]) }}"> <img src="{{ Auth::user()->avatar  }}" width="30px" height="30px" style="border-radius:50%;" alt=""> <strong>{{Auth::user()->firstname . ' ' . Auth::user()->lastname }}</strong> </a></li>
            <li><a data-toggle="tooltip" title="News Feed" href="{{ route('home') }}"><i class="fa fa-newspaper-o" aria-hidden="true"></i> <strong>News Feed</strong></a></li>
            <li><a data-toggle="tooltip" title="Codenection" href="{{ url('/messages') }}"><i class="fa fa-envelope-square" aria-hidden="true"></i><strong> Codenection</strong> </a></li>
            <li><a data-toggle="tooltip" title="Check Plans" href="{{ url('users/check_plans') }}"><i class="fa fa-check-square" aria-hidden="true"></i><strong> Upgrade Plan</strong> </a></li>
            <li><a data-toggle="tooltip" title="Take a curriculum" class="latte-icons" href="{{ url('/users/curriculum') }}"><i class="fa fa-desktop" aria-hidden="true"></i><strong> Curriculums</strong></a></li>
            <li><a data-toggle="tooltip" title="Show your progress" class="latte-icons" href="{{ url('/users/progress') }}"><i class="fa fa-line-chart" aria-hidden="true"></i> <strong> Progress</strong></a></li>

        </ul>
    </div>
    <div class="col-xs-12 col-md-6 col-lg-6">
        <post></post>
        <feed></feed>
    </div>

    <div class="col-xs-12 col-md-3 col-lg-3">
        <div class="pull-right">
            <ul class="home-sidebar friendship-sidebar">
            @foreach($friendship as $f)
                <li><img width="30px" height="30px" src="{{ $f->user->avatar }}" alt=""> <a href="profile/{{$f->user->slug}}">{{ $f->user->firstname }}  {{ $f->user->lastname }}</a></li>
            @endforeach
            </ul>
        </div>
    </div>
</div>
@endsection
