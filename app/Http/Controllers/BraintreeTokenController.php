<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Braintree_ClientToken;

class BraintreeTokenController extends Controller
{
    public function token()
    {
        return response()->json([
            'data' => [
                'token' => "sandbox_y2zh46nw_cgk63bdz3ct4dqym",
            ]
        ]);
    }
}
