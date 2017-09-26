<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    protected $fillable = ['tutorial_id','namee','description','status'];

    public function tutorials(){
        return $this->hasMany('App\Tutorials');
    }

    public function questionnaires(){
        return $this->belongsTo('App\Questionnaires');
    }
}
