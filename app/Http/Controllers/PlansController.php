<?php

namespace App\Http\Controllers;

use App\BillingInfo;
use App\Plans;
use App\User;
use App\PlansContent;
use App\UsersPlan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class PlansController extends Controller
{
    /*public function add(Request $request)
    {
        $this->validate($request,[
            'name' => 'required',
            'price' => 'required',
            'discount' => 'required'
        ]);

        $plans = Plans::create([
            'name' => $request->name,
            'price' => $request->price,
            'discount' => $request->discount,
            'status' => 1
        ]);

        return response()->json([
            'message' => 'Plans created successfully',
            'plans' =>$plans
        ]);
    }*/

    public function plans()
    {

        $plans = Plans::latest()->paginate(10);

        $response = [
            'pagination' => [
                'total' => $plans->total(),
                'per_page' => $plans->perPage(),
                'current_page' => $plans->currentPage(),
                'last_page' => $plans->lastPage(),
                'from' => $plans->firstItem(),
                'to' => $plans->lastItem()
            ],
            'plan' => $plans
        ];
        return response()->json([
            'plans' => $response
        ]);
    }

    /*public function delete($id)
    {
        $plans = Plans::find($id)->delete();

        return response()->json([
            'message'=>'Plan deleted successfully'
        ]);
    }*/

    /*public function update(Request $request,$id)
    {
        $this->validate($request,[
            'name' => 'required',
            'price' => 'required',
            'discount' =>'required'
        ]);

        $plans = Plans::find($id);

        $plans->update($request->all());

        return response()->json([
            'message' => 'Plans updated successfully'
        ]);
    }*/



    public function getPlans()
    {
        $plans = Plans::get();
        foreach ($plans as $plan) {
            $plan->plans_contents = PlansContent::where('plans_id', $plan->id)->get();
        }
        //$plans = Plans::leftJoin('plans_contents','plans.id','=','plans_contents.plans_id')->get();

        return view('plan',compact("plans"));
    }

    public function checkPlans()
    {
        $plans = Plans::get();
        foreach ($plans as $plan) {
            $plan->plans_contents = PlansContent::where('plans_id', $plan->id)->get();
        }

        $usersplans = UsersPlan::where('user_id',Auth::user()->id)->where('status','=',1)->first();

        return view('users.check_plans',compact("plans","usersplans"));
    }

    public function upgradePlans($plan_slug)
    {


        $plans = Plans::where('slug','=',$plan_slug)->first();

        if (Auth::user()->subscribedToPlan($plans->braintree_plan, 'main') || $plans->id === 1 ) {
            return redirect('home')->with('error', 'Unauthorised operation');
        }

        $profile = Auth::user()->profile()->first();
        return view('users.upgrade-plan',compact("plans","profile"));
    }

    public function payNow(Request $data){

        $user = Auth::user()->update([
            'plan_id' => $data->plan
        ]);

        // get the plan after submitting the form

        $plan = Plans::findOrFail($data->plan);

        if (Auth::user()->subscribedToPlan($plan->braintree_plan, 'main')) {
            return redirect('home')->with('error', 'Unauthorised operation');
        }
        // subscribe the user

        if ($data->plan != 1) {
            $payment_method_nonce ='fake-valid-nonce'; //$data->payment_method_nonce;


            //Auth::user()->newSubscription('main', $plan->braintree_plan)->create($payment_method_nonce);

            if (!Auth::user()->subscribed('main')) {
                Auth::user()->newSubscription('main', $plan->braintree_plan)->create($payment_method_nonce);
            } else {
                Auth::user()->subscription('main')->swap($plan->braintree_plan);
                //Auth::user()->newSubscription('main', $plan->braintree_plan)->update($payment_method_nonce);
            }

        }
        else
            $payment_method_nonce = 'Trial Period';

        $userplan = UsersPlan::where('user_id',Auth::user()->id)->first();

        $userplan->update([
            'user_id' =>  Auth::user()->id,
            'plan_id' => $data->plan,
            'trial_days' => '30',
            'status' => 1
        ]);

        $billing = BillingInfo::create([
            'user_id' => Auth::user()->id,
            'plan_id' => $data->plan,
            'billing_name' => $plan->name,
            'billing_address'=> isset(Auth::user()->profile->location) ? Auth::user()->profile->location : $data->billing_address,
            'billing_contact'=> $data->contact,
            'billing_method'=> $payment_method_nonce,
            'billing_duedate'=> Carbon::now()->addDays('30')
        ]);



        return redirect('users/billing-info')->with('success', 'Subscribed to '.$plan->name.' successfully');

    }
}
