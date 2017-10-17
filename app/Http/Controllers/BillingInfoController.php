<?php

namespace App\Http\Controllers;

use App\BillingInfo;
use App\Plans;
use App\UsersPlan;
use App\User;
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

    public function index(){
        $billinginfo = BillingInfo::with(['plans','users'])->paginate(10);
        $response = [
            'pagination' => [
                'total' => $billinginfo->total(),
                'per_page' => $billinginfo->perPage(),
                'current_page' => $billinginfo->currentPage(),
                'last_page' => $billinginfo->lastPage(),
                'from' => $billinginfo->firstItem(),
                'to' => $billinginfo->lastItem()
            ],
            'billinginfo' => $billinginfo

        ];

        return response()->json([
            'billinginfo' => $response
        ]);
    }
}
