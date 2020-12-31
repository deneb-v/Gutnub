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
        $parameters = ['access_type' => 'offline', "prompt" => "select_account"];
        return Socialite::driver('google')->scopes(["https://www.googleapis.com/auth/drive"])->with($parameters)->redirect();
        // return Socialite::driver('google')->with($parameters)->redirect();
    }

    public function googleAuthCallback()
    {
        $google_user = Socialite::driver('google')->user();
        $user = User::where('email',$google_user->getEmail())->first();
        if ($user == null) {
            $name = $google_user->getName();
            $email = $google_user->getEmail();
            $profilePicture = $google_user->getAvatar();
            $refresh_token = $google_user->refreshToken;
            // dump()
            $drive = new GdriveController($refresh_token);
            $gutnubFolderID = $drive->createFolder('Gutnub');

            $user = new User();
            $user->name = $name;
            $user->email = $email;
            $user->gutnubFolderID = $gutnubFolderID;
            $user->profilePicture = $profilePicture;
            $user->refresh_token = $refresh_token;
            $user->save();
        }
        Auth::login($user);
        return redirect()->route('homeView');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
