<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UsersTutorials extends Model
{
    protected $fillable = ['user_id','course_id','tutorial_id','status'];

    public function course(){
        return $this->belongsTo('App\CourseLists');
    }

    public function users(){
        return $this->belongsTo('App\User');
    }

    public function tutorials(){
        return $this->belongsTo('App\Tutorials');
    }
}
