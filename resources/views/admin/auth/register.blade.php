@extends('admin.layouts.app')

@section('content')

    <div class="sign-overlay"></div>
    <div class="signpanel"></div>

    <div class="signup">
        <div class="row">
            <div class="col-sm-5">
                <div class="panel">
                    <div class="panel-heading">
                        <h1>Quirk</h1>
                        <h4 class="panel-title">Create an Account!</h4>
                    </div>
                    <div class="panel-body">
                        <button class="btn btn-primary btn-quirk btn-fb btn-block">Sign Up Using Facebook</button>
                        <div class="or">or</div>
                        <form class="form-horizontal" role="form" method="POST" action="{{ url('/admin/register') }}">
                            {{ csrf_field() }}

                            <div class="form-group mb15 {{ $errors->has('name') ? ' has-error' : '' }}">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus placeholder="Enter Your Full Name">
                            </div>
                            @if ($errors->has('name'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                            @endif


                            <div class="form-group mb15 {{ $errors->has('email') ? ' has-error' : '' }}">
                                <input type="text" class="form-control" id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required placeholder="Enter Email Address">
                            </div>
                            @if ($errors->has('email'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                            @endif


                            <div class="form-group mb15 {{ $errors->has('password') ? ' has-error' : '' }}">
                                <input id="password" type="password" class="form-control" name="password" required placeholder="Enter Your Password">
                            </div>



                            @if ($errors->has('password'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                            @endif

                            <div class="form-group mb15 {{ $errors->has('password') ? ' has-error' : '' }}">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required placeholder="Confirm Your Password">
                            </div>

                            <div class="form-group mb20">
                                <label class="ckbox">
                                    <input type="checkbox" name="checkbox">
                                    <span>Accept terms and conditions</span>
                                </label>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-success btn-quirk btn-block">Create Account</button>
                            </div>
                        </form>
                    </div><!-- panel-body -->
                </div><!-- panel -->
            </div><!-- col-sm-5 -->
            <div class="col-sm-7">
                <div class="sign-sidebar">
                    <h3 class="signtitle mb20">Two Good Reasons to Love Quirk</h3>
                    <p>When it comes to websites or apps, one of the first impression you consider is the design. It needs to be high quality enough otherwise you will lose potential users due to bad design.</p>
                    <p>Below are some of the reasons why you love Quirk.</p>

                    <br>

                    <h4 class="reason">1. Attractive</h4>
                    <p>When your website or app is attractive to use, your users will not simply be using it, they’ll look forward to using it. This means that you should fashion the look and feel of your interface for your users.</p>

                    <br>

                    <h4 class="reason">2. Responsive</h4>
                    <p>Responsive Web design is the approach that suggests that design and development should respond to the user’s behavior and environment based on screen size, platform and orientation. This would eliminate the need for a different design and development phase for each new gadget on the market.</p>

                    <hr class="invisible">

                    <div class="form-group">
                        <a href="{{ url('admin/login') }}" class="btn btn-default btn-quirk btn-stroke btn-stroke-thin btn-block btn-sign">Already a member? Sign In Now!</a>
                    </div>
                </div><!-- sign-sidebar -->
            </div>
        </div>
    </div><!-- signup -->



    <script src="{{ asset('lib/jquery/jquery.js') }}"></script>
    <script src="{{ asset('lib/bootstrap/js/bootstrap.js') }}"></script>
    <script src="{{ asset('lib/select2/select2.js') }}"></script>

    <script>
        $(function() {

            // Select2 Box
            $("select.form-control").select2({ minimumResultsForSearch: Infinity });

        });
    </script>




@endsection