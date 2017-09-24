<?php

namespace App\Http\Controllers;

use App\Tutorials;
use Illuminate\Http\Request;

class TutorialsController extends Controller
{
    public function add(Request $request)
    {
        $this->validate($request,[
            'name' => 'required',
            'description' => 'required',
            'programminglanguage_id' => 'required',
            'media_id' => 'required',

        ]);

        $tutorials = Tutorials::create([
            'name' => $request->name,
            'description' => $request->description,
            'programminglanguage_id' => $request->programminglanguage_id,
            'media_id' => $request->media_id,
            'textarea' => $request->textarea,
            'views' => 1,
            'status' => 1
        ]);

        return response()->json([
            'message' => 'Tutorials created successfully',
            'tutorials' =>$tutorials
        ]);
    }

    public function tutorials()
    {

        $tutorials = Tutorials::with(['programminglanguage','media'])->paginate(10);

        $response = [
            'pagination' => [
                'total' => $tutorials->total(),
                'per_page' => $tutorials->perPage(),
                'current_page' => $tutorials->currentPage(),
                'last_page' => $tutorials->lastPage(),
                'from' => $tutorials->firstItem(),
                'to' => $tutorials->lastItem()
            ],
            'tutorial' => $tutorials
        ];

        return response()->json([
            'tutorial' => $response
        ]);
    }

    public function delete($id)
    {
        $tutorials = Tutorials::find($id)->delete();

        return response()->json([
            'message'=>'Tutorials deleted successfully'
        ]);
    }

    public function update(Request $request,$id)
    {
        $this->validate($request,[
            'name' => 'required',
            'description' => 'required',
            'programminglanguage_id' => 'required',
            'media_id' => 'required',
        ]);

        $tutorials = Tutorials::find($id);

        $tutorials->update($request->all());

        return response()->json([
            'message' => 'Tutorials updated successfully'
        ]);
    }

}
