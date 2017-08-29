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

        \App::abort(404, 'This page is not yet ready.');
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
    protected function findPlayer(string $platform, string $gamertag) : Player
    {
        $players = destiny()->player($gamertag);
        $player = $players->get($platform);

        abort_if(!($player instanceof Player), "The player '$gamertag' on '$platform' could not be found.");

        return $player;
    }
}
