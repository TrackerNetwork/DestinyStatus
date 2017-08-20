<?php

namespace App\Http\Controllers;

use App\Models\Bungie;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{
    public function redirectToProvider()
    {
        return Socialite::with('bungie')->redirect();
    }

    public function handleRefreshProvider()
    {
        return Socialite::with('bungie')->refreshToken(\Auth::user());
    }

    public function handleProviderCallback()
    {
        /** @var Bungie $user */
        $bungie = Socialite::with('bungie')->user();
        \Auth::login($bungie, true);

        \Session::flash('success', 'You have logged in as - <strong>' . $bungie->account->name . '</strong>');
        return redirect('/');
    }

    public function logout()
    {
        \Auth::logout();

        \Session::flash('success', 'You have logged out.');
        return redirect('/');
    }
}
