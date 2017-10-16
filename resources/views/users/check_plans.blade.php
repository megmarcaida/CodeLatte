@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/pricing/style.css') }}">
  

    <div class="container">

        <div class="row">

            <div class="col-xs-12 col-md-12 col-lg-12">

                <div class="header-curriculum"><i class="fa fa-hashtag" aria-hidden="true"></i> Plans</div>

                <div class="cd-pricing-container cd-has-margins">

                    <ul class="cd-pricing-list">
                        @if (count($plans) > 0)
                            {{count($plans) }}
                            @foreach($plans as $plan)
                                @if($plan->id == 2)
                                    <li class="cd-popular">
                                @else
                                    <li>
                                @endif
                                    <header class="cd-pricing-header">
                                        <h2>{{$plan->name}}</h2>

                                        <div class="cd-price">
                                            <span class="cd-currency">$</span>
                                            <span class="cd-value">{{$plan->cost}}</span>
                                            <span class="cd-duration">mo</span>
                                        </div>
                                    </header> <!-- .cd-pricing-header -->

                                    <div class="cd-pricing-body">
                                        <ul class="cd-pricing-features">
                                            @foreach($plan->plans_contents as $planscontent)
                                                <li>{{ $planscontent->description }}</li>
                                            @endforeach
                                        </ul>
                                    </div> <!-- .cd-pricing-body -->

                                    <footer class="cd-pricing-footer">
                                        @if ($usersplans->plan_id != $plan->id && $plan->id != 1)
                                            @if (!Auth::user()->subscribedToPlan($plan->braintree_plan, 'main'))
                                                <a class="cd-select" href="{{ url('users/upgrade') }}/{{ $plan->slug }} ">Select</a>
                                            @endif
                                        @elseif($plan->id === 1)
                                            @if ($usersplans->plan_id > 1)
                                                <b class="cd-select">Plan</b>
                                            @else
                                                <b class="cd-select">Current Plan</b>
                                            @endif

                                        @else
                                            <b class="cd-select">Current Plan</b>
                                        @endif
                                    </footer> <!-- .cd-pricing-footer -->
                                </li>
                            @endforeach
                        @endif
                    </ul> <!-- .cd-pricing-list -->
                </div> <!-- .cd-pricing-container -->
            </div>

        </div>


        @include('users.footer')

    </div>

@endsection
