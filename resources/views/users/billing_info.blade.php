@extends('layouts.app')

@section('content')

    <div class="container">

        <div class="row">

            <div class="col-xs-12 col-md-12 col-lg-12">

                <div class="header-curriculum"><i class="fa fa-hashtag" aria-hidden="true"></i> Billing Info</div>

                <div class="col-xs-12 col-md-9 col-lg-9">
                    <div class="panel panel-default">
                        <div class="panel-heading">Billing History</div>

                        <div class="panel-body">
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th>Bill Name</th>
                                    <th>Billing Address</th>
                                    <th>Billing Contact</th>
                                    <th>Billing Method</th>
                                    <th>Billing Due Date</th>
                                    <th>Billing Created</th>
                                    <th>Plan Avail</th>

                                </tr>
                                </thead>
                                <tbody>
                                    @foreach($billinginfo as $index => $billing)
                                    <tr>
                                        <td>{{ $billing->billing_name }}</td>
                                        <td>{{ $billing->billing_address }}</td>
                                        <td>{{ $billing->billing_contact }}</td>
                                        <td>{{ $billing->billing_method }}</td>
                                        <td>{{ $billing->billing_duedate }}</td>
                                        <td>{{ $billing->created_at }}</td>
                                        <td>{{ $billing->billing_name }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>

                            </table>
                        </div>
                    </div>
                </div>

                <div class="col-xs-12 col-md-3 col-lg-3">
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
