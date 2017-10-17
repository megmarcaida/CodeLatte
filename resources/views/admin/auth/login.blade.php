@extends('admin.layouts.app')

@section('content')
    <div class="sign-overlay"></div>
    <div class="signpanel"></div>

    <div class="panel signin">
        <div class="panel-heading">
            <h1>{{ config('app.name', 'MultiAuth') }}</h1>
            <h4 class="panel-title">Welcome! Please signin.</h4>
        </div>
        <div class="panel-body">
          {{--  <button class="btn btn-primary btn-quirk btn-fb btn-block">Connect with Facebook</button>
            <div class="or">or</div>--}}
            <form class="form-horizontal" role="form" method="POST" action="{{ url('/admin/login') }}">
                {{ csrf_field() }}
                <div class="form-group mb10 {{ $errors->has('email') ? ' has-error' : '' }}">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                        <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus placeholder="Email address">
                    </div>
                    @if ($errors->has('email'))
                        <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                    @endif
                </div>
                <div class="form-group nomargin {{ $errors->has('password') ? ' has-error' : '' }}">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                        <input id="password" type="password" class="form-control" name="password" required placeholder="Password">
                    </div>
                    @if ($errors->has('password'))
                        <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                    @endif
                </div>

                <div class="form-group ">
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : ''}}> Remember Me
                        </label>
                    </div>
               </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-success btn-quirk btn-block">Sign In</button>
                </div>
            </form>
            <div class="text-center nomargin">
                <a class="forgot" href="{{ url('/admin_password/reset') }}">
                    Forgot Your Password?
                </a>
            </div>
            <div class="form-group">
                <a href="{{ url('admin/register') }}" class="btn btn-default btn-quirk btn-stroke btn-stroke-thin btn-block btn-sign">Not a member? Sign up now!</a>
            </div>
        </div>
    </div><!-- panel -->




@endsection