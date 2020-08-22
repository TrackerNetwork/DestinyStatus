<?php

namespace App\Http\Controllers;

use Destiny\Player;

class AccountController extends Controller
{
    /**
     * @param string $platform
     * @param string $name
     *
     * @return string
     */
    public function index(string $platform, string $name)
    {
        $player = $this->findPlayer($platform, $name);
        $profile = app('destiny')->profile($player);

        $profile->loadCharacters();

        return view('profile', [
            'account' => $profile->account,
            'player'  => $player,
            'profile' => $profile,
        ]);
    }

    /**
     * @param string $platform
     * @param string $name
     *
     * @return string
     */
    public function clan(string $platform, string $name)
    {
        $player = $this->findPlayer($platform, $name);
        $group = app('destiny')->groups($player);

        $group->loadAll();

        return view('clan', [
            'player' => $player,
            'group'  => $group,
        ]);
    }

    //-------------------------------------------------------
    // Protected Functions
    //-------------------------------------------------------

    /**
     * @param $platform
     * @param $gamertag
     *
     * @return \Destiny\Player
     */
    protected function findPlayer(string $platform, string $gamertag): Player
    {
        $players = app('destiny')->player($gamertag);
        $player = $players->get($platform);

        abort_if(!($player instanceof Player), 404, "The player '$gamertag' on '$platform' could not be found.");

        return $player;
    }
}
