<?php

use Destiny\Player;

class AccountController extends BaseController
{
	/**
	 * @param string $platform
	 * @param string $gamertag
	 * @return \Destiny\Player
	 */
	protected function findPlayer($platform, $gamertag)
	{
		$players = destiny()->player($gamertag);
		$player = $players->get($platform);

		if ( ! ($player instanceof Player))
		{
			App::abort(404, "The player '$gamertag' on '$platform' could not be found.");
		}

		return $player;
	}

	public function index($platform, $gamertag)
	{
		$player = $this->findPlayer($platform, $gamertag);
		$account = $player->account;
		$account->load();

		return View::make('account', [
			'player'   => $player,
			'platform' => $platform,
			'account'  => $account,
		]);
	}

	public function grimoire($platform, $gamertag)
	{
		$player   = $this->findPlayer($platform, $gamertag);
		$grimoire = $player->grimoire;

		return View::make('grimoire', [
			'player'   => $player,
			'platform' => $platform,
			'grimoire' => $grimoire,
		]);
	}
}
