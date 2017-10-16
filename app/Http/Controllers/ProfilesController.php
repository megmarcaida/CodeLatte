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

        $posts = Post::where('user_id',$user->id);
        foreach ($posts as $post) {
            $post->likes = Like::where('post_id', $post->id)->get();
        }

        return view('profiles.profile')->with(['user'=>$user,'posts'=>$posts]);
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
