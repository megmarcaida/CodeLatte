@extends('layouts.app')

@section('content')

        <div class="container">
            <br>
            <div class="col-lg-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        {{ $user->firstname  }}'s Profile.
                    </div>
                    <div class="panel-body">
                        <div class="text-center">
                            <img src="{{ $user->avatar  }}" width="70px" height="70px" style="border-radius:50%;" alt="">
                        </div>

                        <br>

                        <p class="text-center">
                            {{ $user->profile->location }}
                        </p>

                        <p class="text-center">
                            @if(Auth::id() == $user->id)
                                <a href="{{ route('profile.edit') }}" class="btn btn-lg btn-info">Edit your Profile</a>
                            @endif
                        </p>
                    </div>
                </div>

               @if(Auth::id() !== $user->id)
                    <div class="panel panel-default">

                        <div class="panel-body">
                            <friend :profile_user_id="{{ $user->id }}"></friend>
                        </div>
                    </div>
               @endif

                <div class="panel panel-default">
                    <div class="panel-heading">
                        About Me
                    </div>
                    <div class="panel-body">
                        <p class="text-center">

                            {{ $user->profile->about  }}

                        </p>
                    </div>
                </div>
            </div>
        </div>
@stop