<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BillingInfo extends Model
{
    protected $fillable = ['user_id','plan_id','billing_name','billing_address','billing_contact','billing_method','billing_duedate'];

    public function plans(){
        return $this->belongsTo('App\Plans');
    }

    public function users(){
        return $this->belongsTo('App\User');
    }
}
