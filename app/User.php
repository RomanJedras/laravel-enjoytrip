<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    use Enjoythetrip\Presenters\UserPresenter;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name','surname', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public static $roles = [];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


     public function objects()
    {
        return $this->morphedByMany('App\TouristObject', 'likeable');
    }

    public function photos()
    {
        return $this->morphMany('App\Photo', 'photoable');
    }

     public function larticles()
    {
        return $this->morphedByMany('App\Article', 'likeable');
    }

    public function comments()
    {
        return $this->hasMany('App\Comment');
    }

     public function roles()
    {
        return $this->belongsToMany('App\Role');
    }

    public function hasRole(array $roles)
    {

        foreach($roles as $role)
        {
            
            if(isset(self::$roles[$role])) 
            {
                if(self::$roles[$role])  return true;

            }
            else
            {
                self::$roles[$role] = $this->roles()->where('name', $role)->exists();
                if(self::$roles[$role]) return true;
            }
            
        }
        

        return false;
 
    }

}
