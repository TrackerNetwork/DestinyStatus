<?php

namespace App\Http\Controllers;

use App\Events\BungieSignedIn;
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
        /** @var Bungie $bungie */
        $bungie = Socialite::with('bungie')->user();
        \Auth::login($bungie, true);

        event(new BungieSignedIn($bungie));

        if (!empty($bungie->preferred_account_id)) {
            \Session::flash('success', 'You have logged in as - <strong>'.$bungie->account->name.'</strong>');

            return redirect()->intended('/');
        }

        if ($bungie->accounts->count() == 1) {
            \Session::flash('success', 'You have logged in as - <strong>'.$bungie->accounts->first()->name.'</strong>');
        } else {
            return redirect('/preferred-account');
        }

        return redirect()->intended('/');
    }
}
