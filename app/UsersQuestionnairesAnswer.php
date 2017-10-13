<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UsersQuestionnairesAnswer extends Model
{
   protected $fillable =  ['usersQuizAnswer_id','questionnaire_id','answer','status'];

    public function usersquizanswer(){
        return $this->belongsTo('App\UsersQuizAnswer','usersQuizAnswer_id');
    }

    public function questionnaires(){
        return $this->belongsTo('App\Questionnaires','questionnaire_id');
    }
}
