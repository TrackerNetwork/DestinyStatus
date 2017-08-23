<?php

namespace App\Http\Controllers;

use Destiny\Exotics;
use Destiny\Player;
use Illuminate\Http\Request;
use Illuminate\View\Factory as View;

class AccountController extends Controller
{
    /**
     * @var Request
     */
    public $request;

    /**
     * @var View
     */
    public $view;

    /**
     * HomeController constructor.
     *
     * @param Request $request
     * @param View    $view
     */
    public function __construct(Request $request, View $view)
    {
        $this->request = $request;
        $this->view = $view;
    }

    /**
     * @param $platform string
     * @param $gamertag string
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index($platform, $gamertag)
    {
        $player = $this->findPlayer($platform, $gamertag);
        $account = $player->account;
        if ($account->characters->count() === 0) {
            \App::abort(404, "The player '$gamertag' on '$platform' has no guardians anymore :(");
        }
        $account->load();

        return $this->view->make('account', [
            'player'   => $player,
            'platform' => $platform,
            'account'  => $account,
        ]);
    }

    /**
     * @param $platform string
     * @param $gamertag string
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function grimoire($platform, $gamertag)
    {
        $player = $this->findPlayer($platform, $gamertag);
        $grimoire = $player->grimoire;

        return $this->view->make('grimoire', [
            'player'   => $player,
            'platform' => $platform,
            'grimoire' => $grimoire,
        ]);
    }

    /**
     * @param $platform string
     * @param $gamertag string
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function exotics($platform, $gamertag)
    {
        $player = $this->findPlayer($platform, $gamertag);
        $grimoire = $player->grimoire;

        return $this->view->make('exotics', [
            'player'   => $player,
            'platform' => $platform,
            'grimoire' => $grimoire,
            'exotics'  => new Exotics($grimoire),
        ]);
    }

    /**
     * @param $platform string
     * @param $gamertag string
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function stats($platform, $gamertag)
    {
        $player = $this->findPlayer($platform, $gamertag);
        $account = $player->account;
        $activityStats = destiny()->accountAggregated($account);
        $stats = $account->mergedStats;

        return $this->view->make('stats', [
            'player'        => $player,
            'platform'      => $platform,
            'stats'         => $stats,
            'activityStats' => $activityStats,
        ]);
    }

    /**
     * @param string $platform
     * @param string $gamertag
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function books($platform, $gamertag)
    {
        $player = $this->findPlayer($platform, $gamertag);
        $account = $player->account;
        $books = destiny()->recordBooks($account);

        return $this->view->make('books', [
            'player'      => $player,
            'platform'    => $platform,
            'books'       => $books,
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
    protected function findPlayer($platform, $gamertag)
    {
        $players = destiny()->player($gamertag);
        $player = $players->get($platform);

        if (!($player instanceof Player)) {
            \App::abort(404, "The player '$gamertag' on '$platform' could not be found.");
        }

        return $player;
    }
}
