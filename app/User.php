<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'googleID','refresh_token'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'refresh_token',
    ];

    static public function findUser($googleID){
        return User::where('googleID',$googleID)->first();
    }

    static public function addGoogleUser($name, $email, $googleID, $refresh_token){
        return User::create([
            'name' => $name,
            'email' => $email,
            'googleID' => $googleID,
            'refresh_token' => $refresh_token
        ]);
    }


}
