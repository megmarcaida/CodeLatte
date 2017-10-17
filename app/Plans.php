<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Cashier\Billable;

class Plans extends Model
{
    use Billable;

    protected $fillable = ['name', 'slug', 'braintree_plan', 'cost','trialDuration','trialDurationUnit','discount', 'description'];

    public function plansContent()
    {
        return $this->hasMany('App\PlansContent');
    }

    public function courselist()
    {
        return $this->hasMany('App\CourseLists');
    }

    public function billinginfo()
    {
        return $this->hasMany('App\BillingInfo');
    }
}
