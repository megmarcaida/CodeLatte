<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CodeBlockController extends Controller
{
    public function index()
    {
        return view('users.code-block.index');
    }
}
