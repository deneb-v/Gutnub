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
        'name', 'email', 'gutnubFolderID','profilePicture','refresh_token'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'refresh_token',
    ];

    public function file(){
        return $this->hasMany('App\File', 'userID');
    }

    public function projectMember(){
        return $this->hasMany('App\Project_member', 'userID');
    }

    static public function findUser($email){
        return User::where('email',$email)->first();
    }

    static public function addGoogleUser($name, $email, $gutnubFolderID, $profilePicture, $refresh_token){
        return User::create([
            'name' => $name,
            'email' => $email,
            'gutnubFolderID' => $gutnubFolderID,
            'profilePicture' => $profilePicture,
            'refresh_token' => $refresh_token
        ]);
    }


}
