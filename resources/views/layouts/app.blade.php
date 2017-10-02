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

    <script src="{{ asset('js/app.js') }}"></script>
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
                    <ul class="nav navbar-nav">

                        @if(Auth::check())
                        &nbsp;<unread></unread>
                              <search></search>
                        @endif
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @if (Auth::guest())
                            <li><a class="latte-menu" href="{{ route('login') }}">For Business</a></li>
                            <li><a class="latte-menu" href="{{ route('login') }}">Testimonials</a></li>
                            <li><a class="latte-menu" href="{{ route('login') }}">Login</a></li>
                            <li><a class="free-trial" href="{{ url('plan') }}">Free Trial</a></li>
                        @else
                            <li><a href="{{ route('home') }}">Feed</a></li>
                            <li><a href="{{ route('profile',['slug'=> Auth::user()->slug ]) }}">{{ Auth::user()->name  }}</a></li>
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
    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
</body>
</html>
