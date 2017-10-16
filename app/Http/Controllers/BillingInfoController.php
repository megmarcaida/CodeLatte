<?php

namespace App\Http\Controllers;

use App\BillingInfo;
use App\Plans;
use App\UsersPlan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class BillingInfoController extends Controller
{

    public function billingInfo()
    {
        $usersplan = UsersPlan::where('user_id',Auth::user()->id)->first();

        $plans = Plans::where('id','=',$usersplan->plan_id)->first();

        $users = Auth::user();

        $billinginfo = BillingInfo::where('user_id',Auth::user()->id)->get();

        $profile = Auth::user()->profile()->first();
        return view('users.billing_info',compact("plans","profile","users","billinginfo"));
    }
}
