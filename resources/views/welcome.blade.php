@extends('layouts.app')

@section('content')

            <section id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                <!-- Indicators -->
                <ol class="carousel-indicators">
                    <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                    <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                    <li data-target="#carousel-example-generic" data-slide-to="2"></li>
                </ol>

                <!-- Wrapper for slides -->
                <div class="carousel-inner latte-carousel" role="listbox">
                    <div class="item active">
                        <img class="img-responsive" src="{{ asset('img/banner1.jpg') }}" alt="banner 1">
                        <div class="carousel-caption">
                            ...
                        </div>
                    </div>
                    <div class="item">
                        <img class="img-responsive" src="{{ asset('img/banner2.jpg') }}" alt="banner 2">
                        <div class="carousel-caption">
                            ...
                        </div>
                    </div>
                    <div class="item">
                        <img class="img-responsive" src="{{ asset('img/banner3.jpg') }}" alt="banner 2">
                        <div class="carousel-caption">
                            ...
                        </div>
                    </div>
                </div>



                <!-- Controls -->
                <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
                    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </section>


            <section class="jumbotron process-tree">
                <div class="container">
                    <h2 class="text-center">How Latte Innovation Works</h2>
                    <h4 class="text-center">Achieve your dreams and change the world</h4>

                    <div class="col-xs-12 col-md-8 col-lg-8 col-md-offset-2 col-lg-offset-2">

                        <div class="row">

                            <div class="col-xs-12 col-md-3 col-lg-3">
                                <img class="img-responsive tree" src="{{ asset('img/learn.png') }}" alt="Learn">
                            </div>

                            <div class="col-xs-12 col-md-9 col-lg-9">
                                <h2>Learn</h2>
                                <h4 class="text-justify">Learn from over 1000 videos created by expert teachers
                                    on web design, coding, business, and much more.
                                    Our library is continually refreshed with the latest on web technology
                                    so you'll never fall behind.</h4>
                            </div>

                        </div>

                        <div class="row">

                            <div class="col-xs-12 col-md-3 col-lg-3">
                                <img class="img-responsive tree" src="{{ asset('img/link1.png') }}" alt="Learn">
                            </div>

                            <div class="col-xs-12 col-md-9 col-lg-9">

                            </div>

                        </div>


                        <div class="row">

                            <div class="col-xs-12 col-md-3 col-lg-3">
                                <img class="img-responsive tree" src="{{ asset('img/code.png') }}" alt="Learn">
                            </div>
                            <div class="col-xs-12 col-md-9 col-lg-9">
                                <h2>Practice</h2>
                                <h4 class="text-justify">Practice what you've learned through quizzes and interactive
                                    Code Challenges. This style of practicing will allow you
                                    to retain information you've learned so you can apply it to your
                                    own future projects.</h4>
                            </div>

                        </div>

                        <div class="row">

                            <div class="col-xs-12 col-md-3 col-lg-3">
                                <img class="img-responsive tree" src="{{ asset('img/link2.png') }}" alt="Learn">
                            </div>

                            <div class="col-xs-12 col-md-9 col-lg-9">

                            </div>

                        </div>

                        <div class="row">

                            <div class="col-xs-12 col-md-3 col-lg-3">
                                <img class="img-responsive tree" src="{{ asset('img/earn.png') }}" alt="Learn">
                            </div>
                            <div class="col-xs-12 col-md-9 col-lg-9">
                                <h2>Earn</h2>
                                <h4 class="text-justify">You can earn while you will learn. Study with your own pace, work with no hesitation,
                                it will help you to be a successfull programmer.</h4>
                            </div>

                        </div

                    </div>

                </div>
            </section>

            <section class="info-stuff">
                <div class="container">
                    <h2 class="text-center">Some of the Awesome Stuff You'll Learn</h2>
                    <h4 class="text-center">The fast, easy, and affordable way to build your skills</h4>

                    <div class="col-xs-12 col-md-3 col-lg-3">
                        <img class="img-responsive tree" src="{{ asset('img/builld.png') }}" alt="Learn">
                        <h4 class="text-center">Develop a Website</h4>
                        <h5 class="text-left">You'll learn the basics to building a website with an introduction to text editors, basic HTML tags, and advanced HTML skills.</h5>
                        <a href="{{ url('plan') }}">Get Started</a>
                    </div>

                    <div class="col-xs-12 col-md-3 col-lg-3">
                        <img class="img-responsive tree" src="{{ asset('img/codes.png') }}" alt="Learn">
                        <h4 class="text-center">Learn Coding</h4>
                        <h5 class="text-left">Learn technologies such as Ruby on Rails to help you build the next world changing product.</h5>
                        <a href="{{ url('plan') }}">Get Started</a>
                    </div>

                    <div class="col-xs-12 col-md-3 col-lg-3">
                        <img class="img-responsive tree" src="{{ asset('img/app.png') }}" alt="Learn">
                        <h4 class="text-center">Develop an App</h4>
                        <h5 class="text-left">This is the spot to learn how to build apps. You'll learn the language, tools, and necessary concepts to get your app out the door.</h5>
                        <a href="{{ url('plan') }}">Get Started</a>
                    </div>

                    <div class="col-xs-12 col-md-3 col-lg-3">
                        <img class="img-responsive tree" src="{{ asset('img/bus.png') }}" alt="Learn">
                        <h4 class="text-center">Form a Business</h4>
                        <h5 class="text-left">Find out how to get your business off on the right foot. You'll learn how to iporve yoour business and also your employees knowledge</h5>
                        <a href="{{ url('plan') }}">Get Started</a>
                    </div>


                </div>
            </section>







            @include('includes.data-stuff')
            @include('includes.trial-stuff')
            @include('includes.footer')
@endsection
