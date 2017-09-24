<?php

namespace App\Http\Controllers;

use App\ProgrammingLanguage;
use Illuminate\Http\Request;

class ProgrammingLanguageController extends Controller
{
    public function add(Request $request)
    {
        $this->validate($request,[
            'name' => 'required',
            'description' => 'required'
        ]);

        $programminglanguage = ProgrammingLanguage::create([
            'name' => $request->name,
            'description' => $request->description,
            'status' => 1
        ]);

        return response()->json([
            'message' => 'Programming Language created successfully',
            'programminglanguage' =>$programminglanguage
        ]);
    }

    public function programminglanguage()
    {

        $programminglanguage = ProgrammingLanguage::latest()->paginate(10);

        $response = [
            'pagination' => [
                'total' => $programminglanguage->total(),
                'per_page' => $programminglanguage->perPage(),
                'current_page' => $programminglanguage->currentPage(),
                'last_page' => $programminglanguage->lastPage(),
                'from' => $programminglanguage->firstItem(),
                'to' => $programminglanguage->lastItem()
            ],
            'prog' => $programminglanguage
        ];

        return response()->json([
            'programminglanguage' => $response
        ]);
    }

    public function delete($id)
    {
        $programminglanguage = ProgrammingLanguage::find($id)->delete();

        return response()->json([
            'message'=>'Programming Language deleted successfully'
        ]);
    }

    public function update(Request $request,$id)
    {
        $this->validate($request,[
            'name' => 'required',
            'description' => 'required'
        ]);

        $programminglanguage = ProgrammingLanguage::find($id);

        $programminglanguage->update($request->all());

        return response()->json([
            'message' => 'Programming Language updated successfully'
        ]);
    }
}
