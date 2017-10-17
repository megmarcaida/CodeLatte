<?php

namespace App\Http\Controllers;

use App\CourseLists;
use App\Tutorials;
use App\User;
use App\UsersCourse;
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
            'user_id'=>Auth::user()->id,
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



        $usersquizanswers = UsersQuizAnswer::with('quiz')->where('user_id',Auth::user()->id)->get();
        foreach ($usersquizanswers as $usersquizanswer) {
            $usersquizanswer->usersquestionnairesanswer = UsersQuestionnairesAnswer::where('usersQuizAnswer_id', $usersquizanswer->id)->get();
        }

        $userscourse = UsersCourse::where('user_id',Auth::user()->id)->get();

        $userstutorial = UsersTutorials::with('tutorials')->where('user_id',Auth::user()->id)->get();
        $tutorials = Tutorials::get();

        return view('users.progress',compact("usersquizanswers","userscourse","userstutorial","tutorials"));

    }

    public function progress(){

        $usersquizanswers = UsersQuizAnswer::with('quiz')->where('user_id',Auth::user()->id)->get();
        foreach ($usersquizanswers as $usersquizanswer) {
            $usersquizanswer->usersquestionnairesanswer = UsersQuestionnairesAnswer::with('questionnaires')->where('usersQuizAnswer_id', $usersquizanswer->id)->get();
        }

        $userscourse = UsersCourse::where('user_id',Auth::user()->id)->get();

       $userstutorial = UsersTutorials::with('tutorials')->where('user_id',Auth::user()->id)->get();
        $tutorials = Tutorials::get();

        return view('users.progress',compact("usersquizanswers","userscourse","userstutorial","tutorials"));
    }

    public function progresslist(){

        $usersquizanswer = UsersQuizAnswer::with(['users','quiz'])->paginate(10);
        $response = [
            'pagination' => [
                'total' => $usersquizanswer->total(),
                'per_page' => $usersquizanswer->perPage(),
                'current_page' => $usersquizanswer->currentPage(),
                'last_page' => $usersquizanswer->lastPage(),
                'from' => $usersquizanswer->firstItem(),
                'to' => $usersquizanswer->lastItem()
            ],
            'usersquizanswer' => $usersquizanswer
        ];

        return response()->json([
            'usersquizanswer' => $response
        ]);
    }
}
