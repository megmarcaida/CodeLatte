@extends('layouts.app')

@section('content')


    <div class="container">


        <h1>Gallery</h1>
        <div class="col-md-12">
            <div class="row">
                <hr>

                <div class="gal">
                    @foreach($media as $med)
                        <img src="{{route('getmedia', $med->filename)}}" alt="{{ $med->name }}" class="img-responsive gal-media" />
                    @endforeach
                </div>

            </div>
        </div>
    </div>





    @include('includes.data-stuff')
    @include('includes.trial-stuff')
    @include('includes.footer')
@endsection

<style>
    .gal {


        -webkit-column-count: 3; /* Chrome, Safari, Opera */
        -moz-column-count: 3; /* Firefox */
        column-count: 3;


    }
    .gal img{ width: 100%; padding: 7px 0;}
    @media (max-width: 500px) {

        .gal {
            -webkit-column-count: 1; /* Chrome, Safari, Opera */
            -moz-column-count: 1; /* Firefox */
            column-count: 1;
        }

    }

    .gal img {
        transform:bummer 1s;
        animation: bummer 1s;
        -moz-animation: bummer 0.5s; /* Firefox */
        -webkit-animation: bummer 0.5s; /* Safari and Chrome */
        -o-animation: bummer     0.5s; /* Opera */
        margin-top:-20px;}

    @-webkit-keyframes bummer {
        100% {
            -webkit-transform: scale(1,1);
        }
    }

    @keyframes bummer {
        100% {
            transform: scale(1,1);
        }
    }
</style>
