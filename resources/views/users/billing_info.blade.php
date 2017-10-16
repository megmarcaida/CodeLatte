@extends('layouts.app')

@section('content')

    <div class="container">

        <div class="row">

            <div class="col-xs-12 col-md-12 col-lg-12">

                <div class="header-curriculum"><i class="fa fa-hashtag" aria-hidden="true"></i> Billing Info</div>

                <div class="col-xs-12 col-md-8 col-lg-8">
                    <div class="panel panel-default">
                        <div class="panel-heading">Billing History</div>

                        <div class="panel-body">
                            {{ $users->firstname }}
                        </div>
                    </div>
                </div>

                <div class="col-xs-12 col-md-4 col-lg-4">
                    <div class="panel panel-default">
                        <div class="panel-heading">Manage Subscriptions</div>

                        <div class="panel-body">
                        @if (Auth::user()->subscription('main')->cancelled())
                                <p>Your subscription ends on {{ Auth::user()->subscription('main')->ends_at->format('dS M Y') }}</p>
                                <form action="{{ url('subscription/resume') }}" method="post">
                                    <button type="submit" class="btn btn-default">Resume subscription</button>
                                    {{ csrf_field() }}
                                </form>
                            @else
                                <p>You are currently subscribed to {{ $plans->name }}.</p>
                                <form action="{{ url('subscription/cancel') }}" method="post">
                                    <input type="hidden" name="subscription_id" value="{{ Auth::user()->subscription('main')->id }}">
                                    <button type="submit" class="btn btn-default">Cancel subscription</button>
                                    {{ csrf_field() }}
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

        </div>


        @include('users.footer')

    </div>

@endsection
