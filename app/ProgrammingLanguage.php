<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProgrammingLanguage extends Model
{
    protected $fillable = ['name','description','status'];

    public function tutorials()
    {
        return $this->hasMany('App\Tutorials');
    }
}
