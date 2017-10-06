@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/pricing/style.css') }}">
    <section>
        ABOUT US
    </section>



    @include('includes.data-stuff')
    @include('includes.trial-stuff')
    @include('includes.footer')
@endsection


