<?php

namespace App\Http\Controllers;

use App\Plans;
use App\PlansContent;
use Illuminate\Http\Request;

class PlansContentController extends Controller
{
    public function add(Request $request)
    {
        $this->validate($request,[
            'name' => 'required',
            'description' => 'required',
            'plans_id' => 'required'
        ]);

        $planscontent = PlansContent::create([
            'name' => $request->name,
            'description' => $request->description,
            'plans_id' => $request->plans_id,
            'status' => 1
        ]);

        return response()->json([
            'message' => 'Plans Content created successfully',
            'planscontent' =>$planscontent
        ]);
    }

    public function planscontent()
{

    $planscontent = PlansContent::with('plans')->paginate(10);

    $response = [
        'pagination' => [
            'total' => $planscontent->total(),
            'per_page' => $planscontent->perPage(),
            'current_page' => $planscontent->currentPage(),
            'last_page' => $planscontent->lastPage(),
            'from' => $planscontent->firstItem(),
            'to' => $planscontent->lastItem()
        ],
        'pc' => $planscontent
    ];

    return response()->json([
        'planscontent' => $response
    ]);
}

    public function delete($id)
    {
        $planscontent = PlansContent::find($id)->delete();

        return response()->json([
            'message'=>'Plans Content deleted successfully'
        ]);
    }

    public function update(Request $request,$id)
    {
        $this->validate($request,[
            'name' => 'required',
            'description' => 'required',
            'plans_id' =>'required'
        ]);

        $planscontent = PlansContent::find($id);

        $planscontent->update($request->all());

        return response()->json([
            'message' => 'Plans Content updated successfully'
        ]);
    }
}
