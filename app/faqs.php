<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class faqs extends Model
{
    protected $fillable = ['question','answer','helpCount','status'];

    public function userSupport(){
        return $this->belongsTo('App\UserSupport');
    }
}
