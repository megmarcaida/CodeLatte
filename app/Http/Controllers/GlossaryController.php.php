<?php

namespace App\Http\Controllers;

use App\Glossary;
use Illuminate\Http\Request;

class GlossaryController extends Controller
{
    public function add(Request $request)
{
    $this->validate($request,[
        'word' => 'required',
        'definition' => 'required'
    ]);

    $glossary= Glossary::create([
        'word' => $request->word,
        'definition' => $request->definition,
        'status' => 1
    ]);

    return response()->json([
        'message' => 'Glossary created successfully',
        'glossary' =>$glossary
    ]);
}

    public function glossary()
{

    $glossary = Glossary::latest()->paginate(10);

    $response = [
        'pagination' => [
            'total' => $glossary->total(),
            'per_page' => $glossary->perPage(),
            'current_page' => $glossary->currentPage(),
            'last_page' => $glossary->lastPage(),
            'from' => $glossary->firstItem(),
            'to' => $glossary->lastItem()
        ],
        'gloss' => $glossary
    ];
    return response()->json([
        'glossary' => $response
    ]);
}

    public function delete($id)
{
    $glossary = Glossary::find($id)->delete();

    return response()->json([
        'message'=>'Glossary deleted successfully'
    ]);
}

    public function update(Request $request,$id)
{
    $this->validate($request,[
        'word' => 'required',
        'definition' => 'required'
    ]);

    $glossary = Glossary::find($id);

    $glossary->update($request->all());

    return response()->json([
        'message' => 'Glossary updated successfully'
    ]);
}
}
