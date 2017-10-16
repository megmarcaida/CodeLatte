<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Plans;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

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

    public function cancel(Request $request)
    {
        $user = Auth::user()->subscription('main')->update([
            'ends_at'=> Carbon::now()->addDays(1)
        ]);

        return redirect()->back()->with('success', 'You have successfully cancelled your subscription');
    }

    public function resume(Request $request)
    {
        $request->user()->subscription('main')->resume();

        return redirect()->back()->with('success', 'You have successfully resumed your subscription');
    }
}
