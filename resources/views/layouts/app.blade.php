<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link  rel="icon" type="image/png" href="{{ asset('img/latte-ico.png?12') }}" />
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/noty.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/intlTelInput.css') }}">
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,700' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="https://raw.githubusercontent.com/daneden/animate.css/master/animate.css" type="text/css">

    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
</head>
<body>
    <div id="app">
        <init></init>
        <nav class="navbar navbar-default navbar-static-top latte-nav">
            <div class="container">
                @include ('layouts.notifications.notification')
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
                        <img src="{{ asset('img/latte-ico.png?12') }}" alt="Code Latte"> <b>{{ config('app.name', 'Laravel') }}</b>
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
                            <li><a title="News Feed" href="{{ route('home') }}"class="latte-icons"><i class="fa fa-newspaper-o" aria-hidden="true"></i></a></li>
                            <li><a href="{{ route('profile',['slug'=> Auth::user()->slug ]) }}"> <img src="{{ Auth::user()->avatar  }}" width="30px" height="30px" style="border-radius:50%;" alt=""></a></li>
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
                                        @if (Auth::user()->subscribed('main'))
                                            <a href="{{ url('/users/billing-info') }}">
                                                Manage subscriptions
                                            </a>
                                        @endif
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/vue-focus/2.1.0/vue-focus.min.js"></script>
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
    <script>
        document.onreadystatechange = function () {
            var state = document.readyState
            if (state == 'complete') {
                setTimeout(function(){
                    document.getElementById('payment-button').style.display="block";
                },1000);
            }
        }
    </script>

    <script>
        $( document ).ready(function() {
            setTimeout(function(){
                $('[data-toggle="tooltip"]').tooltip();
                $('[data-toggle="tooltip"]').on('shown.bs.tooltip', function () {
                    $('.tooltip').addClass('animated rubberBand');
                })
            }, 1500);

        })





        $("#btnGetting_started").click(function (e) {
            $("#getting_started").fadeOut('slow');
        });

        function check()
        {

            var contact = document.getElementById('contact');


            var message = document.getElementById('message');

            var goodColor = "#0C6";
            var badColor = "#FF9B37";

            if(contact.value.length!=10){

                contact.style.backgroundColor = badColor;
                message.style.color = badColor;
                message.innerHTML = "required 10 digits, match requested format!"
            }
            else
            {
                message.style.color = goodColor;
                message.innerHTML = "";
                contact.style.backgroundColor = goodColor;
            }
        }

    </script>

    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>

    <script src="https://js.braintreegateway.com/js/braintree-2.32.1.min.js"></script>
    @if(isset($plans->cost))
    <script>
        $.ajax({
            url: '{{ url('braintree/token') }}'
        }).done(function (response) {
            braintree.setup(response.data.token, 'dropin', {
                container: 'dropin-container',
                paypal: {
                    singleUse: true,
                    amount: '{{ $plans->cost }}',
                    currency: 'USD',
                    button: {
                        type: 'checkout'
                    }
                },
                onReady: function () {
                    $('#payment-button').removeClass('hidden');
                }
            });
        });
    </script>
    @endif
    <script src="{{ asset('js/intlTelInput.js') }}"></script>
    <script>

        var telInput = $("#contact"),
            errorMsg = $("#error-msg"),
            validMsg = $("#valid-msg"),
            paymentbutton = $("#payment-button");

        telInput.intlTelInput({
            isValidNumber: true,
            // allowDropdown: false,
            // autoHideDialCode: false,
            // autoPlaceholder: "off",
            // dropdownContainer: "body",
            // excludeCountries: ["us"],
             formatOnDisplay: true,
             geoIpLookup: function(callback) {
               $.get("http://ipinfo.io", function() {}, "jsonp").always(function(resp) {
                 var countryCode = (resp && resp.country) ? resp.country : "";
                 callback(countryCode);
               });
             },
            // hiddenInput: "full_number",
             initialCountry: "auto",
             nationalMode: true,
            // onlyCountries: ['us', 'gb', 'ch', 'ca', 'do'],
             placeholderNumberType: "MOBILE",
            // preferredCountries: ['cn', 'jp'],
            separateDialCode: true,
            utilsScript: "{{ asset('js/utils.js') }}"
        });

        var reset = function() {
            telInput.removeClass("error");
            paymentbutton.removeClass("btn-is-disabled")
            errorMsg.addClass("hide");
            validMsg.addClass("hide");
        };

        // on blur: validate
        telInput.blur(function() {
            reset();
            if ($.trim(telInput.val())) {
                if (telInput.intlTelInput("isValidNumber")) {
                    validMsg.removeClass("hide");
                } else {
                    telInput.addClass("error");
                    paymentbutton.addClass("btn-is-disabled");
                    errorMsg.removeClass("hide");
                }
            }
        });

        // on keyup / change flag: reset
        telInput.on("keyup change", reset);
    </script>


</body>
</html>
