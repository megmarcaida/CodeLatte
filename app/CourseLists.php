<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CourseLists extends Model
{
    protected $fillable = ['name','description','status'];
    public function tutorials()
    {
        return $this->hasMany('App\Tutorials');
    }
}
