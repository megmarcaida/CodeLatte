<?php

namespace App\Http\Controllers;

use App\User;
use App\UsersQuizAnswer;
use App\UsersQuestionnairesAnswer;
use App\Questionnaires;
use App\UsersTutorials;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class UsersQuizAnswerController extends Controller
{
    public function createAnswer(Request $request){
        $score = 0;
        $items = 0;
        $questionnaires = '';
        $course_id = 0;
        $tutorial_id = 0;
        foreach($request->answer as $index => $ans ){
            $questionnaires = Questionnaires::where('id','=',$request->questionnaire_id[$index])->get();
            if ($questionnaires[0]->correct_answer == $ans){
                $score += 1;
            }
            $items += 1;

            $quiz_id = $questionnaires[0]->quiz_id;

            $tutorial_id = $request->tutorial_id[$index];
            $course_id = $request->course_id[$index];

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

        $userstutorial = UsersTutorials::where('user_id',Auth::user()->id)
            ->where('course_id',$course_id)
            ->where('tutorial_id',$tutorial_id)
            ->first();

        UsersTutorials::where('id',$userstutorial->id)->update(['status' => 1]);


        foreach ($request->answer as $index => $answer ) {
                $UserQuestionnairesAnswer = UsersQuestionnairesAnswer::create([
                'usersQuizAnswer_id' => $UserQuizAnswer->id,
                'questionnaire_id' => $request->questionnaire_id[$index],
                'answer' => $answer,
                'status' => 1
            ]);
        }



        return view('users.progress');

    }
}
