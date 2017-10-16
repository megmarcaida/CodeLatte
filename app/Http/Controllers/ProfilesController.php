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

       /* $feed = array();

        foreach(Auth::user()->posts as $post):
            array_push($feed,$post);
        endforeach;*/


        return view('profiles.profile',compact("user"));
    }

    public function edit()
    {
        return view('profiles.edit')->with('info',Auth::user()->profile);
    }

    public function update(request $r)
    {

        $this->validate($r,[
           'location' => 'required',
            'about' => 'required|max:255'
        ]);

        Auth::user()->profile()->update([
            'location' => $r->location,
            'about' => $r->about
        ]);

        if($r->hasFile('avatar'))
        {
            Auth::user()->update([
               'avatar' => $r->avatar->store('public/avatars')
            ]);
        }

        /*dd(Auth::user()->profile);*/
        Session::flash('success','Profile updated');

        return redirect()->back();
    }

}
