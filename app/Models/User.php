<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Hash;//created
use Illuminate\Support\Facades\Gate;


class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


// public function setPasswordAttribute($password){ //created to hash the explicit password,NOT USED YET
//     $this->attributes['password']=Hash::make($password);
// }



    public function roles(){

        return $this->belongsToMany('App\Models\Role'); //relating to roles
    }


    
/**
 * check if the user has a role
 * 
 * 
 * 
 */
    public function hasAnyRole($role){

        return null !== $this->roles()->where('name',$role)->first();
        
    }


    /**
 * check if the user has a any role given
 * 
 * 
 * 
 */

    public function hasAnyRoles($role){

        return null !== $this->roles()->whereIn('name',$role)->first();
        
    }
}
