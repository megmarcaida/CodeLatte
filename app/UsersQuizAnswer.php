<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UsersQuizAnswer extends Model
{
    protected $fillable =['quiz_id','score','items','quiz_status'];

    public function usersquestionnairesanswer(){
        return $this->hasMany('App\UsersQuestionnairesAnswer');
    }
}
