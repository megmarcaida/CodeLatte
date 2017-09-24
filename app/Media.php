<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    protected $fillable = ['title','description','filename','mime','original_filename','status'];

    public function tutorials()
    {
        return $this->hasMany('App\Tutorials');
    }
}
