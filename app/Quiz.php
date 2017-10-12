<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    protected $fillable = ['tutorial_id','name','description','slug','status'];

    public function tutorials(){
        return $this->belongsTo('App\Tutorials','tutorial_id');
    }

    public function questionnaires(){
        return $this->hasMany('App\Questionnaires');
    }
}
