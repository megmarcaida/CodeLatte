<?php

namespace App\Http\Controllers\AdminAuth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

//Validator facade used in validator method
use Illuminate\Support\Facades\Validator;

//Admin Model
use App\Administration;

//Auth Facade used in guard
use Auth;

class RegisterController extends Controller
{
    protected $redirectPath = 'admin/home';
    //shows registration form to seller
    public function showRegistrationForm()
    {
        return view('admin.auth.register');
    }

    public function register(Request $request)
    {

        //Validates data
        $this->validator($request->all())->validate();

        //Create administrator
        $administration = $this->create($request->all());

        //Authenticates admin
        $this->guard()->login($administration);

        //Redirects admin
        return redirect($this->redirectPath);
    }

    //Validates user's Input
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:administrations',
            'password' => 'required|min:6|confirmed',
        ]);
    }

    //Create a new administrator instance after a validation.
    protected function create(array $data)
    {
        return Administration::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }

    //Get the guard to authenticate administrator
    protected function guard()
    {
        return Auth::guard('web_admin');
    }
}
