@extends('layouts.app')

@section('content')
    <div class="container upgrade-content">

        <div class="row">
            <form class="form-horizontal" method="POST" action="{{ route('payment') }}">
                {{ csrf_field() }}
                    <div class="col-md-6">
                        <div class="panel panel-default">

                            <div class="panel-heading"><h3 class="text-center">Billing Information</h3></div>
                            <div class="panel-body">

                                <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
                                    <label for="name" class="col-md-4 control-label">Billing Address</label>

                                    <div class="col-md-6">
                                        <textarea id="billing_address" name="billing_address" type="text"  class="form-control" name="address" required autofocus>{{ $profile->location  }}</textarea>

                                        @if ($errors->has('address'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('address') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group{{ $errors->has('contact') ? ' has-error' : '' }}">
                                    <label for="name" class="col-md-4 control-label">Billing Contact No.</label>

                                    <div class="col-md-6">
                                            <input id="contact" type="text" class="form-control" name="contact" required autofocus>
                                            <span id="valid-msg" class="hide text-success">✓ Valid</span>
                                            <span id="error-msg" class="hide text-danger">Invalid number</span>
                                        @if ($errors->has('contact'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('contact') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>


                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="panel panel-default">

                            <div class="panel-heading"><h3 class="text-center">Upgrade to {{ $plans->name }}</h3></div>
                            <div class="panel-body">

                                <form class="form-horizontal" method="POST" action="{{ route('payment') }}">
                                    {{ csrf_field() }}

                                    @if($plans->id != 1)
                                        <div class="form-group">
                                            <label for="password-confirm" class="col-md-4 control-label">Payment Method : </label>

                                            <div class="col-md-6 ">
                                                <div id="dropin-container"></div>

                                            </div>
                                        </div>
                                    @endif
                                    <input type="hidden" name="plan" value="{{ $plans->id }}">
                                    <div class="form-group">
                                        <div class="col-md-6 col-md-offset-4">
                                            <button id="payment-button" type="submit"  class="btn btn-primary btn-flat payment-button">
                                                Pay Now
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
            </form>
        </div>
    </div>

    @include('users.footer')

@endsection
