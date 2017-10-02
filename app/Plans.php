<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Plans extends Model
{
    protected $fillable = ['name', 'slug', 'braintree_plan', 'cost', 'description'];

    public function plansContent()
    {
        return $this->hasMany('App\PlansContent');
    }

    public function courselist()
    {
        return $this->hasMany('App\CourseLists');
    }
}
