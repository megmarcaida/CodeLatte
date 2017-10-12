<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/noty.css') }}" rel="stylesheet">

    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,700' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="https://raw.githubusercontent.com/daneden/animate.css/master/animate.css" type="text/css">
</head>
<body>
    <div id="app">
        <init></init>
        <nav class="navbar navbar-default navbar-static-top latte-nav">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand latte-brand" href="{{ url('/') }}">
                        {{ config('app.name', 'Laravel') }}
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav latte-nav">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @if (Auth::guest())
                            <li><a title="Testimonials" class="latte-menu" href="{{ url('testimonials') }}">Testimonials</a></li>
                            <li><a title="About" class="latte-menu" href="{{ url('about') }}">About</a></li>
                            <li><a title="Gallery" class="latte-menu" href="{{ url('gallery') }}">Gallery</a></li>
                            <li><a title="Faqs" class="latte-menu" href="{{ url('faqs') }}">Faqs</a></li>
                            <li><a title="Login" class="latte-menu" href="{{ route('login') }}">Login</a></li>
                            <li><a title="Try our plans" class="free-trial" href="{{ url('plan') }}">Free Trial</a></li>
                        @else
                            <search></search>
                            <unread></unread>
                            <li><a title="Take a curriculum" class="latte-icons" href="{{ url('/users/curriculum') }}"><i class="fa fa-laptop" aria-hidden="true"></i></a></li>
                            <li><a title="Show your progress" class="latte-icons" href="{{ url('/users/progress') }}"><i class="fa fa-line-chart" aria-hidden="true"></i></a></li>
                            <li><a title="Upgrade Plans" class="latte-icons" href="{{ url('/users/check_plans') }}"><i class="fa fa-check-square-o" aria-hidden="true"></i></a></li>
                            <li><a title="Check your billing" class="latte-icons" href="{{ url('/users/billing_info') }}"><i class="fa fa-credit-card" aria-hidden="true"></i></a></li>
                            <li><a title="News Feed" href="{{ route('home') }}"class="latte-icons"><i class="fa fa-newspaper-o" aria-hidden="true"></i></a></li>
                            <li><a href=""> <img src="{{ Auth::user()->avatar  }}" width="30px" height="30px" style="border-radius:50%;" alt=""></a></li>
                            <li><a class="latte-menu" title="Go to your profile" href="{{ route('profile',['slug'=> Auth::user()->slug ]) }}">{{ Auth::user()->firstname  }}</a></li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">

                                    <li>
                                        <a href="#">Settings</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>



        @yield('content')
        @if (Auth::check())
        <notification :id="{{ Auth::id() }}"></notification>
        @endif

        <audio id="noty_audio">
            <source src="{{ asset('audio/you-wouldnt-believe.mp3') }}">
            <source src="{{ asset('audio/you-wouldnt-believe.ogg') }}">
        </audio>
    </div>

    <!-- Scripts -->



    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/noty.min.js') }}"></script>
    <script src="//cdn.jsdelivr.net/mojs/latest/mo.min.js"></script>
    <script>
        @if(Session::has('success'))
              $(document).ready(function(){
                    var n = new Noty({
                        type: 'success',
                        layout: 'bottomLeft',
                        text: '{{ Session::get('success') }}',
                    }).show();
                });
        @endif
    </script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    <script>
        $( document ).ready(function() {
            setTimeout(function(){
                $('[data-toggle="tooltip"]').tooltip();
                $('[data-toggle="tooltip"]').on('shown.bs.tooltip', function () {
                    $('.tooltip').addClass('animated rubberBand');
                })
            }, 1500);

        })

        function playVideo() {
            var video = document.getElementById('videoAllUrBase');
            var message = document.getElementById('vidMessage');
            var button = document.getElementById('playButton');

            if (video.paused) {
                video.play();
                button.value = "Pause";
                message.innerHTML = "The video is playing, click the Pause button to pause the video.";
            } else {
                video.pause();
                button.value = "Play";
                message.innerHTML = "The video is paused, click the Play button to resume the video.";
            }

            video.onended = videoEnded;
        }

        function videoEnded() {
            var video = document.getElementById('videoAllUrBase');
            var message = document.getElementById('vidMessage');
            //message.innerHTML = "The video has ended, click Play to restart the video.";
            message.style.display = "block";
        }

        function skip(value) {
            var video = document.getElementById("videoAllUrBase");
            video.currentTime += value;
            alert(video.currentTime);
        }
    </script>

    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
    @if (!Auth::check())
    <script src="https://js.braintreegateway.com/js/braintree-2.30.0.min.js"></script>
    <script>
        $.ajax({
            url: '{{ url('braintree/token') }}'
        }).done(function (response) {
            braintree.setup(response.data.token, 'dropin', {
                container: 'dropin-container',
                onReady: function () {
                    $('#payment-button').removeClass('hidden');
                }
            });
        });
    </script>

    @endif
</body>
</html>
