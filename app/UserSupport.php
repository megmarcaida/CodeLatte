<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserSupport extends Model
{

    public function faqs(){
        return $this->hasMany('App\faqs');
    }
}
