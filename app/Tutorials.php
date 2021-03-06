<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tutorials extends Model
{
    protected $fillable = ['name','description','textarea','programminglanguage_id','media_id','course_id','views','slug','status'];
    public function programminglanguage()
    {
        return $this->belongsTo('App\ProgrammingLanguage','programminglanguage_id');
    }

    public function media()
    {
        return $this->belongsTo('App\Media','media_id');
    }

    public function courselist()
    {
        return $this->belongsTo('App\CourseLists','course_id');
    }

    public function quiz(){
        return $this->hasMany('App\Quiz');
    }

    public function userstutorials(){
        return $this->hasMany('App\UsersTutorials');
    }
}
