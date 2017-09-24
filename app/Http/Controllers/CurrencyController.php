<?php

namespace App\Http\Controllers;

use App\Currency;
use Illuminate\Http\Request;

class CurrencyController extends Controller
{
    public function add(Request $request)
    {
        $this->validate($request,[
            'name' => 'required',
            'description' => 'required'
        ]);

        $currency= Currency::create([
            'name' => $request->name,
            'description' => $request->description,
            'status' => 1
        ]);

        return response()->json([
            'message' => 'Currency created successfully',
            'currency' =>$currency
        ]);
    }

    public function currency()
    {

        $currency = Currency::latest()->paginate(10);

        $response = [
            'pagination' => [
                'total' => $currency->total(),
                'per_page' => $currency->perPage(),
                'current_page' => $currency->currentPage(),
                'last_page' => $currency->lastPage(),
                'from' => $currency->firstItem(),
                'to' => $currency->lastItem()
            ],
            'curr' => $currency
        ];

        return response()->json([
            'currency' => $response
        ]);
    }

    public function delete($id)
    {
        $currency = Currency::find($id)->delete();

        return response()->json([
            'message'=>'Currency deleted successfully'
        ]);
    }

    public function update(Request $request,$id)
    {
        $this->validate($request,[
            'name' => 'required',
            'description' => 'required'
        ]);

        $currency = Currency::find($id);

        $currency->update($request->all());

        return response()->json([
            'message' => 'Currency updated successfully'
        ]);
    }
}
