<?php

namespace App;

use Storage;
use App\Traits\Friendable;
use Laravel\Scout\Searchable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Cashier\Billable;

class User extends Authenticatable
{
    use Notifiable;
    use Friendable;
    use Searchable;
    use Billable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username','firstname','lastname', 'email', 'password','slug','gender','avatar','plan_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function profile()
    {
        return $this->hasOne('App\Profile');
    }

    public function posts()
    {
        return $this->hasMany('App\Post')->orderBy('id','DESC');
    }

    public function getAvatarAttribute($avatar)
    {
        return asset(Storage::url($avatar));
    }

    public function userscourse(){
        return $this->hasMany('App\UsersCourse');
    }

    public function userstutorials(){
        return $this->hasMany('App\UsersTutorials');
    }

    public function usersquizanswer(){
        return $this->belongsTo('App\UsersQuizAnswer');
    }

    public function billinginfo()
    {
        return $this->hasMany('App\BillingInfo');
    }
}
