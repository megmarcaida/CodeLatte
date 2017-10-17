@extends('layouts.app')

@section('content')

    <div class="container">

        <div class="panel-group" id="accordion">
            <div class="faqHeader">Frequently Asked questions</div>
            @foreach($faqs as $faq)
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse{{$faq->id}}"> {{$faq->question}}</a>
                    </h4>
                </div>
                <div id="collapse{{$faq->id}}" class="panel-collapse collapse">
                    <div class="panel-body">
                        {{$faq->answer}}
                    </div>
                </div>
            </div>
            @endforeach
        </div>

    </div>




    @include('includes.data-stuff')
    @include('includes.trial-stuff')
    @include('includes.footer')
@endsection
<style>
    .faqHeader {
        font-size: 27px;
        margin: 20px;
    }

    .panel-heading [data-toggle="collapse"]:after {
        font-family: 'Glyphicons Halflings';
        content: "\e072"; /* "play" icon */
        float: right;
        color: #F58723;
        font-size: 18px;
        line-height: 22px;
        /* rotate "play" icon from > (right arrow) to down arrow */
        -webkit-transform: rotate(-90deg);
        -moz-transform: rotate(-90deg);
        -ms-transform: rotate(-90deg);
        -o-transform: rotate(-90deg);
        transform: rotate(-90deg);
    }

    .panel-heading [data-toggle="collapse"].collapsed:after {
        /* rotate "play" icon from > (right arrow) to ^ (up arrow) */
        -webkit-transform: rotate(90deg);
        -moz-transform: rotate(90deg);
        -ms-transform: rotate(90deg);
        -o-transform: rotate(90deg);
        transform: rotate(90deg);
        color: #454444;
    }
</style>
