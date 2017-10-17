<?php

namespace App\Http\Controllers;

use App\faqs;
use Illuminate\Http\Request;


class FaqsController extends Controller
{
    public function add(Request $request)
    {
        $this->validate($request,[
            'question' => 'required',
            'answer' => 'required'
        ]);

        $faq= faqs::create([
            'question' => $request->question,
            'answer' => $request->answer,
            'helpCount' => 0,
            'status' => 1
        ]);

        return response()->json([
           'message' => 'Faqs created successfully',
            'faq' =>$faq
        ]);
    }

    public function faqs()
    {

        $faqs = faqs::latest()->paginate(10);

        $response = [
            'pagination' => [
                'total' => $faqs->total(),
                'per_page' => $faqs->perPage(),
                'current_page' => $faqs->currentPage(),
                'last_page' => $faqs->lastPage(),
                'from' => $faqs->firstItem(),
                'to' => $faqs->lastItem()
            ],
            'faq' => $faqs
        ];
        return response()->json([
           'faqs' => $response
        ]);
    }

    public function delete($id)
    {
        $faq = faqs::find($id)->delete();

        return response()->json([
            'message'=>'Faq deleted successfully'
        ]);
    }

    public function update(Request $request,$id)
    {
        $this->validate($request,[
            'question' => 'required',
            'answer' => 'required'
        ]);

        $faq = faqs::find($id);

        $faq->update($request->all());

        return response()->json([
            'message' => 'Faq updated successfully'
        ]);
    }
    public function index()
    {
        $faqs = Faqs::get();

        return view('faqs',compact('faqs'));
    }

}
