<?php

namespace App\Http\Controllers\AdminAuth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

//Class needed for login and Logout logic
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use Auth;
class AdminLoginController extends Controller
{
    protected $redirectTo = '/admin/home';
    //
    use AuthenticatesUsers;

    //Custom guard for seller
    protected function guard()
    {
        return Auth::guard('web_admin');
    }

    //Shows seller login form
    public function showLoginForm()
    {
        return view('admin.auth.login');
    }



}
