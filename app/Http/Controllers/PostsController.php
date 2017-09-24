<?php

namespace App\Http\Controllers;

use App\Post;
use Auth;
use Illuminate\Http\Request;


class PostsController extends Controller
{
    public function store(Request $request)
    {
        return Post::create([
           'user_id' => Auth::id(),
            'content' => $request->content
        ]);
    }
}
