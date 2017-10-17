<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UsersPlan extends Model
{
    protected $fillable = ['user_id','plan_id','trial_days','status'];

    public function plans(){
        return $this->belongsTo('App\Plans','plan_id');
    }

    public function users(){
        return $this->belongsTo('App\User','user_id');
    }
}
