@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/pricing/style.css') }}">
    <section>


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
                                <a class="cd-select" href="{{ url('register') }}/{{ $plan->slug }} ">Select</a>
                            </footer> <!-- .cd-pricing-footer -->
                        </li>
                    @endforeach
                @endif
            </ul> <!-- .cd-pricing-list -->
        </div> <!-- .cd-pricing-container -->

    </section>

    @include('includes.data-stuff')
    @include('includes.trial-stuff')
    @include('includes.footer')
@endsection


