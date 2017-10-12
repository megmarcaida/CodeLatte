<?php

namespace App\Http\Controllers;

use App\Questionnaires;
use App\Quiz;
use App\Tutorials;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    public function add(Request $request)
    {
        $this->validate($request,[
            'name' => 'required',
            'description' => 'required',
            'tutorial_id' => 'required'

        ]);

        $quiz = Quiz::create([
            'name' => $request->name,
            'description' => $request->description,
            'tutorial_id' => $request->tutorial_id,
            'slug' => str_slug($request->name),
            'status' => 1
        ]);

        return response()->json([
            'message' => 'Quiz created successfully',
            'quiz' =>$quiz
        ]);
    }

    public function quiz()
    {

        $quiz = Quiz::with('tutorials')->paginate(10);

        $response = [
            'pagination' => [
                'total' => $quiz->total(),
                'per_page' => $quiz->currentPage(),
                'last_page' => $quiz->lastPage(),
                'from' => $quiz->firstItem(),
                'to' => $quiz->lastItem()
            ],
            'quiz' => $quiz
        ];

            return response()->json([
            'quiz' => $response
        ]);
    }

    public function quizDetails($id)
    {

        $quizdetails = Questionnaires::where('quiz_id','=',$id)->paginate(10);

        $response = [
            'pagination' => [
                'total' => $quizdetails->total(),
                'per_page' => $quizdetails->perPage(),
                'current_page' => $quizdetails->currentPage(),
                'last_page' => $quizdetails->lastPage(),
                'from' => $quizdetails->firstItem(),
                'to' => $quizdetails->lastItem()
            ],
            'quizdetails' => $quizdetails
        ];

        return response()->json([
            'quizdetails' => $response
        ]);
    }

    public function delete($id)
    {
        $quiz = Quiz::find($id)->delete();

        return response()->json([
            'message'=>'Quiz deleted successfully'
        ]);
    }

    public function update(Request $request,$id)
    {
        $this->validate($request,[
            'name' => 'required',
            'description' => 'required',

        ]);

        $quiz = Quiz::find($id);

        $quiz->update($request->all());

        return response()->json([
            'message' => 'Quiz updated successfully'
        ]);
    }

    public function getQuiz($quiz_slug){

        $quiz = Quiz::with('tutorials')->where('slug',$quiz_slug)->first();
        $tutorials = Tutorials::with('programminglanguage')->where('id',$quiz->tutorial_id)->first();
        $questionnaires = Questionnaires::where('quiz_id','=',$quiz->id)->get();

        return view('users.take-quiz')->with(['quiz' => $quiz,'questionnaires' => $questionnaires,'tutorials' => $tutorials]);
    }

    protected function createAnswer(Request $request)
    {

        $this->validate($request,[
            'location' => 'required',
            'about' => 'required|max:255'
        ]);

        Auth::user()->profile()->update([
            'location' => $r->location,
            'about' => $r->about
        ]);

        if($r->hasFile('avatar'))
        {
            Auth::user()->update([
                'avatar' => $r->avatar->store('public/avatars')
            ]);
        }

        /*dd(Auth::user()->profile);*/
        Session::flash('success','Profile updated');

        return redirect()->back();

    }
}
