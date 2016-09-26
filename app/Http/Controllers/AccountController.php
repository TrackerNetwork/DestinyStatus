<?php

namespace App\Http\Controllers;

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
	 * @param Request $request
	 * @param View $view
	 */
	public function __construct(Request $request, View $view)
	{
		$this->request = $request;
		$this->view = $view;
	}

	/**
	 * @param $platform string
	 * @param $gamertag string
	 * @return \Illuminate\Contracts\View\View
	 */
	public function index($platform, $gamertag)
	{
		$player = $this->findPlayer($platform, $gamertag);
		$account = $player->account;
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

	//-------------------------------------------------------
	// Protected Functions
	//-------------------------------------------------------

	/**
	 * @param $platform
	 * @param $gamertag
	 * @return \Destiny\Player
	 */
	protected function findPlayer($platform, $gamertag)
	{
		$players = destiny()->player($gamertag);
		$player = $players->get($platform);

		if (!($player instanceof Player))
		{
			\App::abort(404, "The player '$gamertag' on '$platform' could not be found.");
		}

		return $player;
	}
}
