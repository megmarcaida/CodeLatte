<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CourseLists extends Model
{
    protected $fillable = ['name','description','plan_id','status'];
    public function tutorials()
    {
        return $this->hasMany('App\Tutorials');
    }
    public function plans()
    {
        return $this->belongsTo('App\Plans','plan_id');
    }
}
