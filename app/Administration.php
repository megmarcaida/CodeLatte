<?php

namespace App;

/*use Illuminate\Database\Eloquent\Model;*/
use Illuminate\Foundation\Auth\User as Authenticatable;
class Administration extends Authenticatable
{
    //Mass assignable attributes
    protected $fillable = [
        'name', 'email', 'password',
    ];

    //hidden attributes
    protected $hidden = [
        'password', 'remember_token',
    ];
}
