@extends('layouts.app')

@section('content')

    <div class="container">

        <div class="row">

            <div class="col-xs-12 col-md-12 col-lg-12">

                <div class="header-curriculum"><i class="fa fa-hashtag" aria-hidden="true"></i> Progress</div>

                @if(count($usersquizanswers)>0)
                    @foreach($usersquizanswers as $usersquizanswer)
                        {{$usersquizanswer->usersquestionnairesanswer}}
                    @endforeach
                @endif
            </div>

        </div>


        @include('users.footer')

    </div>

@endsection
