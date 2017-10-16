<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UsersPlan extends Model
{
    protected $fillable = ['user_id','plan_id','trial_days','status'];

}
