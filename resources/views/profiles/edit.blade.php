@extends('layouts.app')

@section('content')
    <div class="container latte-profile">
        <div class="row">
            <form action="{{ route('profile.update')  }}" method="post" enctype="multipart/form-data">

                {{ csrf_field() }}

                <div class="col-xs-12 col-md-4 col-lg-4">
                    <div class="panel panel-default">
                        <div class="panel-heading">Personal Info</div>
                        <div class="panel-body">

                            <div class="form-group">
                                <label for="firstname">First Name</label>
                                <input type="text" name="firstname" value="{{ $info->user->firstname }}" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="confirmpassword">Last Name</label>
                                <input type="text" name="lastname" value="{{ $info->user->lastname }}" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="contactnumber">Contact Number</label>
                                <input id="contact" type="text" class="form-control" value="{{ $info->user->mobile }}" name="mobile" required autofocus>
                                <span id="valid-msg" class="hide text-success">✓ Valid</span>
                                <span id="error-msg" class="hide text-danger">Invalid number</span>
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading">Change Password</div>
                        <div class="panel-body">

                            <div class="form-group">
                                <label for="password">Old Password</label>
                                <input type="password" name="oldpassword" class="form-control" >
                            </div>

                            <div class="form-group">
                                <label for="confirmpassword">New Password</label>
                                <input type="password" name="newpassword" class="form-control" >
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-md-8 col-lg-8">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Edit your profile
                        </div>
                        <div class="panel-body">
                            <div class="form-group">
                                <label for="avatar">Upload avatar</label>
                                <input type="file" name="avatar" value="{{ $info->location  }}" class="form-control" accept="image/*">
                            </div>

                            <div class="form-group">
                                <label for="location">location</label>
                                <input type="text" name="location" value="{{ $info->location  }}" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="about">About me</label>
                                <textarea name="about" id="about" cols="50" rows="10" class="form-control" required>{{ $info->about }}</textarea>
                            </div>


                            <div class="form-group">
                                <p class="text-center">
                                    <button class="btn btn-primary btn-lg btn-block" type="submit">Save Your Information</button>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

            </form>
        </div>
    </div>
@endsection
