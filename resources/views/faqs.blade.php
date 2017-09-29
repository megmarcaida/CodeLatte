@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/pricing/style.css') }}">
    <section>
       faqs
    </section>



    <section class="data-stuff">


        <div class="container">

            <div class="col-xs-12 col-md-12 col-lg-12">
                <h2 class="text-center">Latte Innovation is trusted by 265,000+ students and companies worldwide</h2>
            </div>

            <div class="col-xs-12 col-md-8 col-lg-8 col-md-offset-2 col-lg-offset-2">
                <img class="img-responsive twit center-block"  src="{{ asset('img/twit.png') }}" alt="twit">
            </div>

            <div class="col-xs-12 col-md-6 col-lg-6 ">
                <h4 class="text-left">"Latte innovation believe that everyone should have a oppurtunity to learn how to code! So it provides a comprehensive and simple platform for the training ground of every user.”</h4>
            </div>

            <div class="col-xs-12 col-md-6 col-lg-6 ">
                <h4 class="text-left">"Latte innovation believe that everyone should have a oppurtunity to learn how to code! So it provides a comprehensive and simple platform for the training ground of every user.”</h4>
            </div>

        </div>

    </section>

    <section class="trial-stuff">


        <div class="container">

            <div class="col-xs-12 col-md-6 col-lg-6 col-md-offset-3 col-lg-offset-3">
                <div class="jumbotron trial-center">
                    <h3>A superior experience</h3>
                    <ul>
                        <li>Learn and explore from different videos</li>
                        <li>Practive every lesson you've learn by our Developers Environment </li>
                        <li>Ask and communicate to others using our social media </li>
                    </ul>
                    <a href="{{ route('register') }}" class="form-control btn btn-brown">Start Now</a>
                </div>
            </div>

        </div>

    </section>

    @include('includes.footer')
@endsection


