@extends('layouts.app')

@section('content')

    <div class="container">

        <div class="row">

            <div class="col-xs-12 col-md-12 col-lg-12">
                <div class="bg-bill-error">
                    You have an overdue payment, so you don't currently have full access to our learning material. If you're ready to start learning again,
                    <a href=""> click here to update your payment method.</a>
                </div>
            </div>

           <curriculum></curriculum>
        </div>

        @include('users.footer')

    </div>
@endsection
