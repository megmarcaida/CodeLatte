<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tutorials extends Model
{
    protected $fillable = ['name','description','textarea','programminglanguage_id','media_id','views','status'];
    public function programminglanguage()
    {
        return $this->belongsTo('App\ProgrammingLanguage');
    }

    public function media()
    {
        return $this->belongsTo('App\Media');
    }

    public function courselist()
    {
        return $this->hasMany('App\CourseList');
    }
}
