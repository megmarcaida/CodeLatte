@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/pricing/style.css') }}">
    <section>


        <div class="cd-pricing-container">

            <ul class="cd-pricing-list cd-bounce-invert">
                <li>
                    <ul class="cd-pricing-wrapper">
                        <li data-type="monthly" class="is-visible">
                            <header class="cd-pricing-header">
                                <h2>Basic</h2>

                                <div class="cd-price">
                                    <span class="cd-currency">$</span>
                                    <span class="cd-value">30</span>
                                    <span class="cd-duration">mo</span>
                                </div>
                            </header> <!-- .cd-pricing-header -->

                            <div class="cd-pricing-body">
                                <ul class="cd-pricing-features">
                                    <li><em>256MB</em> Memory</li>
                                    <li><em>1</em> User</li>
                                    <li><em>1</em> Website</li>
                                    <li><em>1</em> Domain</li>
                                    <li><em>Unlimited</em> Bandwidth</li>
                                    <li><em>24/7</em> Support</li>
                                </ul>
                            </div> <!-- .cd-pricing-body -->

                            <footer class="cd-pricing-footer">
                                <a class="cd-select" href="http://codyhouse.co/?p=429">Select</a>
                            </footer> <!-- .cd-pricing-footer -->
                        </li>

                        <li data-type="yearly" class="is-hidden">
                            <header class="cd-pricing-header">
                                <h2>Basic</h2>
                                <div class="cd-price">
                                    <span class="cd-currency">$</span>
                                    <span class="cd-value">320</span>
                                    <span class="cd-duration">yr</span>
                                </div>
                            </header> <!-- .cd-pricing-header -->

                            <div class="cd-pricing-body">
                                <ul class="cd-pricing-features">
                                    <li><em>256MB</em> Memory</li>
                                    <li><em>1</em> User</li>
                                    <li><em>1</em> Website</li>
                                    <li><em>1</em> Domain</li>
                                    <li><em>Unlimited</em> Bandwidth</li>
                                    <li><em>24/7</em> Support</li>
                                </ul>
                            </div> <!-- .cd-pricing-body -->

                            <footer class="cd-pricing-footer">
                                <a class="cd-select" href="http://codyhouse.co/?p=429">Select</a>
                            </footer> <!-- .cd-pricing-footer -->
                        </li>
                    </ul> <!-- .cd-pricing-wrapper -->
                </li>

                <li class="cd-popular">
                    <ul class="cd-pricing-wrapper">
                        <li data-type="monthly" class="is-visible">
                            <header class="cd-pricing-header">
                                <h2>Popular</h2>

                                <div class="cd-price">
                                    <span class="cd-currency">$</span>
                                    <span class="cd-value">60</span>
                                    <span class="cd-duration">mo</span>
                                </div>
                            </header> <!-- .cd-pricing-header -->

                            <div class="cd-pricing-body">
                                <ul class="cd-pricing-features">
                                    <li><em>512MB</em> Memory</li>
                                    <li><em>3</em> Users</li>
                                    <li><em>5</em> Websites</li>
                                    <li><em>7</em> Domains</li>
                                    <li><em>Unlimited</em> Bandwidth</li>
                                    <li><em>24/7</em> Support</li>
                                </ul>
                            </div> <!-- .cd-pricing-body -->

                            <footer class="cd-pricing-footer">
                                <a class="cd-select" href="http://codyhouse.co/?p=429">Select</a>
                            </footer> <!-- .cd-pricing-footer -->
                        </li>

                        <li data-type="yearly" class="is-hidden">
                            <header class="cd-pricing-header">
                                <h2>Popular</h2>

                                <div class="cd-price">
                                    <span class="cd-currency">$</span>
                                    <span class="cd-value">630</span>
                                    <span class="cd-duration">yr</span>
                                </div>
                            </header> <!-- .cd-pricing-header -->

                            <div class="cd-pricing-body">
                                <ul class="cd-pricing-features">
                                    <li><em>512MB</em> Memory</li>
                                    <li><em>3</em> Users</li>
                                    <li><em>5</em> Websites</li>
                                    <li><em>7</em> Domains</li>
                                    <li><em>Unlimited</em> Bandwidth</li>
                                    <li><em>24/7</em> Support</li>
                                </ul>
                            </div> <!-- .cd-pricing-body -->

                            <footer class="cd-pricing-footer">
                                <a class="cd-select" href="http://codyhouse.co/?p=429">Select</a>
                            </footer> <!-- .cd-pricing-footer -->
                        </li>
                    </ul> <!-- .cd-pricing-wrapper -->
                </li>

                <li>
                    <ul class="cd-pricing-wrapper">
                        <li data-type="monthly" class="is-visible">
                            <header class="cd-pricing-header">
                                <h2>Premier</h2>

                                <div class="cd-price">
                                    <span class="cd-currency">$</span>
                                    <span class="cd-value">90</span>
                                    <span class="cd-duration">mo</span>
                                </div>
                            </header> <!-- .cd-pricing-header -->

                            <div class="cd-pricing-body">
                                <ul class="cd-pricing-features">
                                    <li><em>1024MB</em> Memory</li>
                                    <li><em>5</em> Users</li>
                                    <li><em>10</em> Websites</li>
                                    <li><em>10</em> Domains</li>
                                    <li><em>Unlimited</em> Bandwidth</li>
                                    <li><em>24/7</em> Support</li>
                                </ul>
                            </div> <!-- .cd-pricing-body -->

                            <footer class="cd-pricing-footer">
                                <a class="cd-select" href="http://codyhouse.co/?p=429">Select</a>
                            </footer>  <!-- .cd-pricing-footer -->
                        </li>

                        <li data-type="yearly" class="is-hidden">
                            <header class="cd-pricing-header">
                                <h2>Premier</h2>
                                <div class="cd-price">
                                    <span class="cd-currency">$</span>
                                    <span class="cd-value">950</span>
                                    <span class="cd-duration">yr</span>
                                </div>
                            </header> <!-- .cd-pricing-header -->

                            <div class="cd-pricing-body">
                                <ul class="cd-pricing-features">
                                    <li><em>1024MB</em> Memory</li>
                                    <li><em>5</em> Users</li>
                                    <li><em>10</em> Websites</li>
                                    <li><em>10</em> Domains</li>
                                    <li><em>Unlimited</em> Bandwidth</li>
                                    <li><em>24/7</em> Support</li>
                                </ul>
                            </div> <!-- .cd-pricing-body -->

                            <footer class="cd-pricing-footer">
                                <a class="cd-select" href="http://codyhouse.co/?p=429">Select</a>
                            </footer>  <!-- .cd-pricing-footer -->
                        </li>
                    </ul> <!-- .cd-pricing-wrapper -->
                </li>
            </ul> <!-- .cd-pricing-list -->
        </div> <!-- .cd-pricing-container -->
    </section>

    @include('includes.data-stuff')
    @include('includes.trial-stuff')
    @include('includes.footer')
@endsection


