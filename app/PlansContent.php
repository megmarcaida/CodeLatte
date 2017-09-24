<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PlansContent extends Model
{
    protected $fillable = ['plans_id','name','description','status'];

    public function plans()
    {
        return $this->belongsTo('App\Plans');
    }
}
