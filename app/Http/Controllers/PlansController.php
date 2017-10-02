<?php

namespace App\Http\Controllers;

use App\Plans;
use App\PlansContent;
use Illuminate\Http\Request;

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
}
