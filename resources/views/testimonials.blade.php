@extends('layouts.app')

@section('content')

    <h1 class="text-center">Testimonials</h1>
    <div class="container content">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="testimonials">
                    <div class="active item">
                        <blockquote><p>This feature is amazing! I can definitely see this as a life changer especially when we can do and understand the lessons and complete these observations on their own.</p></blockquote>
                        <div class="carousel-info">
                            <img alt="" src="{{ asset('images/photos/latte-ico.png') }}" class="pull-left">
                            <div class="pull-left">
                                <span class="testimonials-name">Alaina Wilson</span>
                                <span class="testimonials-post"> Training Coordinator. ,Hohman Plating.</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container content">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="testimonials">
                    <div class="active item">
                        <blockquote><p>We recently rolled out the e-learning solution with 100+ courses and 200+ trainees across our 9 offices in 6 different countries. Roll out was flawless and the trainees have stated how user-friendly the system is to use. Support in setting up the system, and ongoing support in maintaining the live system has been second to none, with support staff being available out of standard office hours has been ideal as a UK-headquartered company.</p></blockquote>
                        <div class="carousel-info">
                            <img alt="" src="{{ asset('images/photos/latte-ico.png') }}" class="pull-left">
                            <div class="pull-left">
                                <span class="testimonials-name">Richard Underwood</span>
                                <span class="testimonials-post">Quality Assurance Professional, Quanticate</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container content">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="testimonials">
                    <div class="active item">
                        <blockquote><p>We are having a lot of positive feedback about your new LMS.  It is so exciting to have such great results from our employees. Recently we received a suggestion from a supervisor for Winterwood.  She requested access to see her employee activity results for the team of managers she supervises and e-learning had this feature right there.</p></blockquote>
                        <div class="carousel-info">
                            <img alt="" src="{{ asset('images/photos/latte-ico.png') }}" class="pull-left">
                            <div class="pull-left">
                                <span class="testimonials-name">Ariane Butcher</span>
                                <span class="testimonials-post"> Corporate Trainer Winterwood, Inc.</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container content">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="testimonials">
                    <div class="active item">
                        <blockquote><p>The Code Latter feature is very useful! My favorite feature is that codeblock are able to see the completion reports, rather than the admin having to send them.</p></blockquote>
                        <div class="carousel-info">
                            <img alt="" src="{{ asset('images/photos/latte-ico.png') }}" class="pull-left">
                            <div class="pull-left">
                                <span class="testimonials-name">Trina McKie</span>
                                <span class="testimonials-post"> President, NPLI</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container content">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="testimonials">
                    <div class="active item">
                        <blockquote><p>Adding and removing subscription capabilities to users has been helpful for our online training programs. Mainly it has given me more access without having hesitate wit users who were no longer allowed Supervisor access to the online program allowing only the right users access to training and compliance documentation reports. The savings in terms of hours spent getting them these reports as well as the overall ease of use means we can dedicate our resources to serving our users and focusing on our core mission.</p></blockquote>
                        <div class="carousel-info">
                            <img alt="" src="{{ asset('images/photos/latte-ico.png') }}" class="pull-left">
                            <div class="pull-left">
                                <span class="testimonials-name">Alexys Cran</span>
                                <span class="testimonials-post"> Student Services Coordinator, Cornerstone International College</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>




    @include('includes.data-stuff')
    @include('includes.trial-stuff')
    @include('includes.footer')
@endsection
<style>
    /* Content */
    .content {
        padding-top: 30px;
    }

    /* Testimonials */
    .testimonials blockquote {
        background: #f8f8f8 none repeat scroll 0 0;
        border: medium none;
        color: #666;
        display: block;
        font-size: 14px;
        line-height: 20px;
        padding: 15px;
        position: relative;
    }
    .testimonials blockquote::before {
        width: 0;
        height: 0;
        right: 0;
        bottom: 0;
        content: " ";
        display: block;
        position: absolute;
        border-bottom: 20px solid #fff;
        border-right: 0 solid transparent;
        border-left: 15px solid transparent;
        border-left-style: inset; /*FF fixes*/
        border-bottom-style: inset; /*FF fixes*/
    }
    .testimonials blockquote::after {
        width: 0;
        height: 0;
        right: 0;
        bottom: 0;
        content: " ";
        display: block;
        position: absolute;
        border-style: solid;
        border-width: 20px 20px 0 0;
        border-color: #e63f0c transparent transparent transparent;
    }
    .testimonials .carousel-info img {
        border: 1px solid #f5f5f5;
        border-radius: 150px !important;
        height: 75px;
        padding: 3px;
        width: 75px;
    }
    .testimonials .carousel-info {
        overflow: hidden;
    }
    .testimonials .carousel-info img {
        margin-right: 15px;
    }
    .testimonials .carousel-info span {
        display: block;
    }
    .testimonials span.testimonials-name {
        color: #e6400c;
        font-size: 16px;
        font-weight: 300;
        margin: 23px 0 7px;
    }
    .testimonials span.testimonials-post {
        color: #656565;
        font-size: 12px;
    }
</style>


