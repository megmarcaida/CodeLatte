@extends('layouts.app')

@section('content')

        <div class="container">
            <br>
            <div class="col-xs-12 col-md-4 col-lg-4">
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
            <div class="col-xs-12 col-md-8 col-lg-8">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <form action="{{ url('/create/post') }}" method="post">
                            {{ csrf_field() }}
                            <textarea rows="3" class="form-control" content="content" id="content"></textarea>

                            <br>
                            <button class="btn btn-success pull-right">
                                Share your thoughts...
                            </button>
                        </form>
                    </div>
                </div>

                @if(count($user->posts) > 0)

                    @foreach( $user->posts as $post)
                        <div class="panel panel-default">
                            <a href="">
                                <img src="{{ $user->avatar  }}" width="30px" height="30px" style="border-radius:50%;" alt="">
                                {{ $user->firstname . " " . $user->lastname  }}
                            </a>
                            <br>
                            <div>{{ $post->content }}</div>

                            <hr>
                            @foreach($post->likes as $likes)

                            <br>
                            @if(isset($likes->id) && $likes->user->id== $user->id )

                                    <a href="">Unlike</a>
                            @elseif($likes->user->id== $user->id)
                                    <a href="#">{{ $likes->user->firstname . " " . $likes->user->lastname  }}</a>

                            @endif

                            @endforeach


                            @foreach($post->likes as $likes)

                                <p class="text-center displayInlineBlock">
                                    @if($likes->user->id == $user->id )
                                            @if(count($post->likes) > 1)
                                                <a href="{{ $likes->user->slug }}">You </a>and
                                            @else
                                                <a href="{{ $likes->user->slug }}">You</a>,
                                            @endif
                                        @else

                                        @if(count($post->likes) > 1)
                                            <a href="{{ $likes->user->slug }}">{{ $likes->user->firstname . " " . $likes->user->lastname  }}</a>
                                        @else
                                            <a href="{{ $likes->user->slug }}">{{ $likes->user->firstname . " " . $likes->user->lastname  }}</a>
                                        @endif

                                    @endif
                                    {{-- <img data-toggle="tooltip" title="{{ $likes->user->firstname . " " . $likes->user->lastname  }}" src="{{$likes->user->avatar}}" width="15px" height="15px" class="avatar-like">--}}
                                </p>
                            @endforeach
                            like this.
                        </div>
                        <br>
                    @endforeach
                @endif


            </div>
        </div>
@stop