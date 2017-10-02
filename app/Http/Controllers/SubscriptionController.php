<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Plans;

class SubscriptionController extends Controller
{
    public function store(Request $request)
    {
        // get the plan after submitting the form
        $plan = Plans::findOrFail($request->plan);

        // subscribe the user
        $request->user()->newSubscription('main', $plan->braintree_plan)->create($request->payment_method_nonce);

        // redirect to home after a successful subscription
        return redirect('home');
    }
}
