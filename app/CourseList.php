<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CourseList extends Model
{
    protected $fillable = ['name','description','tutorials_id','status'];
    public function tutorials()
    {
        return $this->belongsTo('App\Tutorials');
    }
}
