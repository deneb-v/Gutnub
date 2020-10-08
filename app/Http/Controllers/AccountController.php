<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class AccountController extends Controller
{
    public function loginView(){
        return view('login');
    }

    public function redirectToGoogleAuth(){
        $parameters = ['access_type' => 'offline'];
        return Socialite::driver('google')->scopes(["https://www.googleapis.com/auth/drive"])->with($parameters)->redirect();
    }

    public function googleAuthCallback(){
        $google_user = Socialite::driver('google')->user();
        // dd($google_user);
        $user = User::findUser($google_user->id);
        if($user==null){
            $name = $google_user->name;
            $googleID = $google_user->id;
            $email = $google_user->email;
            $refresh_token = $google_user->refreshToken;

            $user = User::addGoogleUser($name,$email,$googleID,$refresh_token);
        }
        Auth::login($user);
        // dd(Auth::user());

        return redirect()->route('homeView');
    }

    public function logout(){
        Auth::logout();
        return redirect()->route('login');
    }
}
