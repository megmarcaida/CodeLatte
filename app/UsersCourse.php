<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UsersCourse extends Model
{
    protected $fillable = ['user_id','course_id','status'];

    public function course(){
        return $this->belongsTo('App\CourseLists');
    }

    public function users(){
        return $this->belongsTo('App\User');
    }
}
