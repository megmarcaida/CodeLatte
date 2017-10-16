<?php

namespace App\Http\Controllers;

use App\Questionnaires;
use Illuminate\Http\Request;

class QuestionnairesController extends Controller
{
    public function add(Request $request)
    {
        $this->validate($request,[
            'quiz_id' => 'required',
            'question_text' => 'required',
            'correct_answer' => 'required'
        ]);

        $correct_answer = '';
        switch ($request->correct_answer) {
            case 'choice1':
                $correct_answer = $request->choice1;
                break;
            case 'choice2':
                $correct_answer = $request->choice2;
                break;
            case 'choice3':
                $correct_answer = $request->choice3;
                break;
            case 'choice4':
                $correct_answer = $request->choice4;
                break;
            case 'choice5':
                $correct_answer = $request->choice5;
                break;

        }

        $questionnaires = Questionnaires::create([
            'quiz_id' => $request->quiz_id,
            'question_text' => $request->question_text,
            'code_snippet' => $request->code_snippet,
            'answer_explanation' => $request->answer_explanation,
            'more_info_link' => $request->more_info_link,
            'choice1' => $request->choice1,
            'choice2' => $request->choice2,
            'choice3' => $request->choice3,
            'choice4' => $request->choice4,
            'choice5' => $request->choice5,
            'correct_answer' => $correct_answer,
            'status' => 1
        ]);



        return response()->json([
            'message' => 'Questionnaire created successfully',
            'questionnaires' =>$questionnaires
        ]);
    }

    public function questionnaires()
    {
        $questionnaires = Questionnaires::with(['quiz'])->paginate(10);
        $response = [
            'pagination' => [
                'total' => $questionnaires->total(),
                'per_page' => $questionnaires->perPage(),
                'current_page' => $questionnaires->currentPage(),
                'last_page' => $questionnaires->lastPage(),
                'from' => $questionnaires->firstItem(),
                'to' => $questionnaires->lastItem()
            ],
            'questionnaires' => $questionnaires
        ];

        return response()->json([
            'questionnaires' => $response
        ]);
    }

    public function delete($id)
    {
        $questionnaires = Questionnaires::find($id)->delete();

        return response()->json([
            'message'=>'Questionnaire deleted successfully'
        ]);
    }

    public function update(Request $request,$id)
    {
        $this->validate($request,[
            'quiz_id' => 'required',
            'question_text' => 'required',
            'correct_answer' => 'required'
        ]);

        $questionnaires = Questionnaires::find($id);


        $correct_answer = '';
        switch ($request->correct_answer) {
            case 'choice1':
                $correct_answer = $request->choice1;
                break;
            case 'choice2':
                $correct_answer = $request->choice2;
                break;
            case 'choice3':
                $correct_answer = $request->choice3;
                break;
            case 'choice4':
                $correct_answer = $request->choice4;
                break;
            case 'choice5':
                $correct_answer = $request->choice5;
                break;

        }

        $questionnaires->update([
            'quiz_id' => $request->quiz_id,
            'question_text' => $request->question_text,
            'code_snippet' => $request->code_snippet,
            'answer_explanation' => $request->answer_explanation,
            'more_info_link' => $request->more_info_link,
            'choice1' => $request->choice1,
            'choice2' => $request->choice2,
            'choice3' => $request->choice3,
            'choice4' => $request->choice4,
            'choice5' => $request->choice5,
            'correct_answer' => $correct_answer,
            'status' => 1
        ]);


        return response()->json([
            'message' => 'Questionnaire updated successfully'
        ]);
    }
}
