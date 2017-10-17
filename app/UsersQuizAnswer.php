<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UsersQuizAnswer extends Model
{
    protected $fillable =['user_id','quiz_id','score','items','quiz_status'];

    public function usersquestionnairesanswer(){
        return $this->hasMany('App\UsersQuestionnairesAnswer');
    }

    public function quiz(){
        return $this->belongsTo('App\Quiz');
    }

    public function users(){
        return $this->belongsTo('App\User');
    }
}
