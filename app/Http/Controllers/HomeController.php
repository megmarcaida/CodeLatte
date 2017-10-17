<?php

namespace App\Http\Controllers;

use Auth;
use App\Friendship;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $friendship = Friendship::with('user')->where(function($q) {
            $q->where('requester', Auth::user()->id)
                ->orWhere('user_requested', Auth::user()->id);
        })->where('status',1)->get();

        return view('home',compact('friendship'));
    }

    public function notifications()
    {
        Auth::user()->unreadNotifications->markAsRead();

        return view('nots')->with('nots', Auth::user()->notifications);
    }
}
