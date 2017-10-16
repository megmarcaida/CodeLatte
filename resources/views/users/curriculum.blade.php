@extends('layouts.app')

@section('content')

    <div class="container">

        <div class="row">

            <div class="col-xs-12 col-md-12 col-lg-12">

                <div class="header-curriculum"><i class="fa fa-hashtag" aria-hidden="true"></i> Curriculum</div>
                <?php
                $plandate = Carbon\Carbon::parse($userplans->created_at);
                $now = Carbon\Carbon::now();
                $length = $plandate->diffInDays($now);

                ?>
                @if ($length > 7)
                    <div class="bg-bill-error">
                        You have an overdue payment, so you don't currently have full access to our learning material. If you're ready to start learning again,
                        <a href=""> click here to update your payment method.</a>
                    </div>
                @endif

                <div id="getting_started" class="panel">
                    <div class="panel-heading">
                        <button type="button" class="close" id="btnGetting_started">
                            <span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
                        </button>
                    </div>
                    <div class="panel-body">
                        <div class="col-xs-12 col-md-6 col-lg-6">
                            <h1>Getting started</h1>
                            Welcome to the Curriculum. You'll be led through a series of Tutorials and Workshops so you can efficiently master the skills you need to achieve your goals.
                            <br><br>
                            <button class="btn btn-success">Take a tour</button>
                        </div>
                        <div class="col-xs-12 col-md-6 col-lg-6">
                        </div>
                    </div>
                </div>
            </div>

           <curriculum></curriculum>
        </div>

        @include('users.footer')

    </div>
@endsection
