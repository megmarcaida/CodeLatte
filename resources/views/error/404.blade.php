<!DOCTYPE html>
<html>
<head>
    <title>404 not found.</title>
    <style>
        body{
            background-color: #d8d1c7 !important;
            width: 100%;
            overflow: hidden;
        }

        .error{
            position: absolute;
            top:25%;
            text-align: center;
            font-size: 10em !important;
            width:100%;
        }

        img.dbl{
            position: absolute;
            bottom: 0;
        }

        img.context{
            position: absolute;
            bottom:0;
            z-index:2;
            width: 100%;
            -moz-animation: 4s infinite slide-left-to-right-slow;
            -webkit-animation: 4s infinite slide-left-to-right-slow;
            -o-animation: 4s infinite slide-left-to-right-slow;
            animation: 4s infinite slide-left-to-right-slow;
        }
        img.corn1{
            position: absolute;
            bottom:0;
            z-index:1;
            -moz-animation: 3s infinite slide-top;
            -webkit-animation: 3s infinite slide-top;
            -o-animation: 3s infinite slide-top;
            animation: 3s infinite slide-top;
        }
        img.corn2{
            position: absolute;
            bottom:4em;
            right:10em;
            z-index:1;
            -moz-animation: 5s infinite slide-top-slow;
            -webkit-animation: 5s infinite slide-top-slow;
            -o-animation: 5s infinite slide-top-slow;
            animation: 5s infinite slide-top-slow;
        }
        .error >h1 a{
            text-decoration: none;
        }


        /*1st Image*/
        @-webkit-keyframes slide-top {
            0% {
                bottom: 0;
            }
            50% {
                bottom: 120px;
            }
            100% {
                bottom: 0;
            }
        }


        @-moz-keyframes slide-top {
            0% {
                bottom: 0;
            }
            50% {
                bottom: 120px;
            }
            100% {
                bottom: 0;
            }
        }


        @-o-keyframes slide-top {
            0% {
                bottom: 0;
            }
            50% {
                bottom: 120px;
            }
            100% {
                bottom: 0;
            }
        }

        @keyframes slide-top {
            0% {
                bottom: 0;
            }
            50% {
                bottom: 120px;
            }
            100% {
                bottom: 0;
            }
        }


        /*2nd Image*/
        @-webkit-keyframes slide-top-slow {
               0% {
                   bottom: 0;
               }
               50% {
                   bottom: 90px;
               }
               100% {
                   bottom: 0;
               }
           }


        @-moz-keyframes slide-top-slow {
            0% {
                bottom: 0;
            }
            50% {
                bottom: 90px;
            }
            100% {
                bottom: 0;
            }
        }


        @-o-keyframes slide-top-slow {
            0% {
                bottom: 0;
            }
            50% {
                bottom: 90px;
            }
            100% {
                bottom: 0;
            }
        }

        @keyframes slide-top-slow {
            0% {
                bottom: 0;
            }
            50% {
                bottom: 90px;
            }
            100% {
                bottom: 0;
            }
        }

        /*3rd Image*/
        @-webkit-keyframes slide-left-to-right-slow {
            0% {
                right: 0;
            }
            50% {
                right: 90px;
            }
            100% {
                right: 0;
            }
        }


        @-moz-keyframes slide-left-to-right-slow {
            0% {
                right: 0;
            }
            50% {
                right: 90px;
            }
            100% {
                right: 0;
            }
        }


        @-o-keyframes slide-left-to-right-slow {
            0% {
                right: 0;
            }
            50% {
                right: 90px;
            }
            100% {
                right: 0;
            }
        }

        @keyframes slide-left-to-right-slow {
            0% {
                right: 0;
            }
            50% {
                right: 30px;
            }
            100% {
                right: 0;
            }
        }


    </style>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,700' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="https://raw.githubusercontent.com/daneden/animate.css/master/animate.css" type="text/css">
</head>
<body>
<div class="error">404
    <h4>Page not found.</h4>
    <h1><a href="{{ url('/') }}">Back to homepage</a></h1>
</div>
<img class="corn1" src="{{ asset('img/corn1.png') }}" alt="">
<img class="corn2" src="{{ asset('img/corn2.png') }}" alt="">
<img class="dbl" src="{{ asset('img/dark-brown-layer.png') }}" alt="">
<img class="context" src="{{ asset('img/light-brown-layer.png') }}" alt="">

</body>
</html>