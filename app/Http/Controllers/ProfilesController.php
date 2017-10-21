<?php

namespace App\Http\Controllers;

use App\Like;
use App\Post;
use Auth;
use Session;
use App\User;
use Illuminate\Http\Request;

class ProfilesController extends Controller
{
    public function index($slug)
    {
        $user = User::where('slug',$slug)->first();
        $user->posts()->orderBy('id','DESC')->get();

        return view('profiles.profile',compact("user"));
    }

    public function edit()
    {
        return view('profiles.edit')->with('info',Auth::user()->profile);
    }

    public function update(request $r)
    {
        $message="";
        /*if (isset($r['oldpassword']))
        {
            if(bcrypt($r['oldpassword']) == Auth::user()->password) {
                Auth::user()->update([
                    'password' => bcrypt($r['newpassword']),
                ]);
                $message .= "Password has been changed";

            }
            else{
                $message .= "Your old password is incorrect.";
            }
        }*/

        $this->validate($r,[
           'location' => 'required',
            'about' => 'required|max:255',
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
        ]);

        Auth::user()->profile()->update([
            'location' => $r->location,
            'about' => $r->about
        ]);

        if($r->hasFile('avatar'))
        {
            Auth::user()->update([
               'avatar' => $r->avatar->store('public/avatars'),
            ]);

        }

        $us = Auth::user()->update([
            'firstname' => $r['firstname'],
            'lastname' => $r['lastname'],
            'mobile' => $r['mobile'],
        ]);


        Session::flash('success', "Profile successfully updated.");
        return redirect()->back();


    }

}
