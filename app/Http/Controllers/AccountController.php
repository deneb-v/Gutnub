<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class AccountController extends Controller
{
    public function loginView()
    {
        return view('login');
    }

    public function redirectToGoogleAuth()
    {
        $parameters = ['access_type' => 'offline'];
        return Socialite::driver('google')->scopes(["https://www.googleapis.com/auth/drive"])->with($parameters)->redirect();
    }

    public function googleAuthCallback()
    {
        $google_user = Socialite::driver('google')->user();
        $user = User::findUser($google_user->getEmail());
        dump($user);
        if ($user == null) {
            $name = $google_user->getName();
            $email = $google_user->getEmail();
            $profilePicture = $google_user->getAvatar();
            $refresh_token = $google_user->refreshToken;
            // dump()
            $drive = new GdriveController($refresh_token);
            $gutnubFolderID = $drive->createFolder('Gutnub');

            $user = User::addGoogleUser($name, $email, $gutnubFolderID, $profilePicture, $refresh_token);
        }
        Auth::login($user);
        // dd(Auth::user());

        return redirect()->route('homeView');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
