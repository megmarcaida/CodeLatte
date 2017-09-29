<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Questionnaires extends Model
{
    protected $fillable = ['quiz_id','question_text','code_snippet','answer_explanation','more_info_link','choice1','choice2','choice3','choice4','choice5','correct_answer','status'];

    public function quiz(){
        return $this->hasMany('App\Quiz','quiz_id');
    }
}
