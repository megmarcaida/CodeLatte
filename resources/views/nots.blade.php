@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">

                <div class="header-curriculum"><i class="fa fa-hashtag" aria-hidden="true"></i> Notifications</div>
                <div class="panel panel-default">

                    <div class="panel-body">
                        <ul class="list-group">
                            @foreach($nots as $not)
                                <li class="list-group-item">
                                    <a href="profile/{{ str_slug($not->data['slug']) }}">{{ $not->data['name'] }}</a>&nbsp; {{ $not->data['message'] }}
                                    <span class="pull-right">{{ $not->created_at }}</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        @include('users.footer')
    </div>
@endsection
