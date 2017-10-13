<?php

namespace App\Http\Controllers;

use App\UsersQuizAnswer;
use App\UsersQuestionnairesAnswer;
use App\Questionnaires;
use Illuminate\Http\Request;

class UsersQuizAnswerController extends Controller
{
    public function createAnswer(Request $request){
        $score = 0;
        $items = 0;
        $questionnaires = '';
        foreach($request->answer as $index => $ans ){
            $questionnaires = Questionnaires::where('id','=',$request->questionnaire_id[$index])->get();
            if ($questionnaires[0]->correct_answer == $ans){
                $score += 1;
            }
            $items += 1;

            $quiz_id = $questionnaires[0]->quiz_id;
        }
        $passScore = $items * .70;

        if($score > $passScore)
            $quiz_status = 1;
        else
            $quiz_status = 0;

        $UserQuizAnswer = UsersQuizAnswer::create([
            'quiz_id' => $quiz_id,
            'score' => $score,
            'items' => $items,
            'quiz_status' => $quiz_status
        ]);

        foreach ($request->answer as $index => $answer ) {
                $UserQuestionnairesAnswer = UsersQuestionnairesAnswer::create([
                'usersQuizAnswer_id' => $UserQuizAnswer->id,
                'questionnaire_id' => $request->questionnaire_id[$index],
                'answer' => $answer,
                'status' => 1
            ]);
        }

    }
}
