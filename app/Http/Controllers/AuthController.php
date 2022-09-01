<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{
    public function loginView()
    {
        return view('pages.auth.login');
    }

    public function oauthGoogleRedirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function oauthGoogleCallback()
    {
        $google_user = Socialite::driver('google')->user();

        $user = User::updateOrCreate([
            'google_id' => $google_user->id,
        ], [
            'name' => $google_user->name,
            'email' => $google_user->email,
            'google_token' => $google_user->token
        ]);

        Auth::login($user);
        return redirect()->route('dashboard.index');
    }
}
