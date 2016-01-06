<?php namespace Destiny;

class DestinyPlatform
{
	protected function request($uri, $params = [], $cacheMinutes = null)
	{
		return new DestinyRequest($uri, $params, $cacheMinutes);
	}

	public function manifest()
	{
		return $this->request("destiny/manifest/");
	}

	public function advisors()
	{
		return $this->request("destiny/advisors/", next_daily());
	}

	public function searchDestinyPlayer($gamertag)
	{
		$gamertag = rawurlencode(trim($gamertag));

		return $this->request("destiny/searchdestinyplayer/all/$gamertag/", CACHE_PLAYER);
	}

	public function grimoire(Player $player)
	{
		return $this->request("destiny/vanguard/grimoire/$player->membershipType/$player->membershipId/", ['flavour' => 'true'], CACHE_DEFAULT);
	}

	public function account(Player $player)
	{
		return $this->request("destiny/$player->membershipType/account/$player->membershipId/summary/", CACHE_DEFAULT);
	}

	public function inventory(Character $character)
	{
		$membershipType = $character->membershipType;
		$membershipId = $character->membershipId;
		$characterId = $character->characterId;

		return $this->request("destiny/$membershipType/account/$membershipId/character/$characterId/inventory/summary/", CACHE_DEFAULT);
	}

	public function progression(Character $character)
	{
		$membershipType = $character->membershipType;
		$membershipId = $character->membershipId;
		$characterId = $character->characterId;

		return $this->request("destiny/$membershipType/account/$membershipId/character/$characterId/progression/", CACHE_DEFAULT);
	}

	public function activities(Character $character)
	{
		$membershipType = $character->membershipType;
		$membershipId = $character->membershipId;
		$characterId = $character->characterId;

		return $this->request("destiny/$membershipType/account/$membershipId/character/$characterId/activities/", CACHE_DEFAULT);
	}

	public function weapons(Character $character)
	{
		$membershipType = $character->membershipType;
		$membershipId = $character->membershipId;
		$characterId = $character->characterId;

		return $this->request("destiny/stats/uniqueweapons/$membershipType/$membershipId/$characterId/", CACHE_DEFAULT);
	}

	public function raids(Character $character)
	{
		return $this->statsActivityHistory($character, "Raid");
	}

	public function arenas(Character $character)
	{
		return $this->statsActivityHistory($character, "ArenaChallenge");
	}

	public function pve(Character $character)
	{
		return $this->statsActivityHistory($character, "AllPvE", 0, 35);
	}

	public function statsAccount(Player $player)
	{
		return $this->request("destiny/stats/account/$player->membershipType/$player->membershipId/", ['groups' => ['General']], CACHE_DEFAULT);
	}

	public function statsCharacter(Character $character, array $groups = ['Medals', 'Enemies'], array $modes = ['AllPvE', 'AllPvP'])
	{
		$membershipType = $character->membershipType;
		$membershipId = $character->membershipId;
		$characterId = $character->characterId;

		$uri = "destiny/stats/$membershipType/$membershipId/$characterId/";
		$params = ['groups' => $groups, 'modes' => $modes];

		return $this->request($uri, $params, CACHE_DEFAULT);
	}

	/**
	 * @param \Destiny\Character $character
	 * @param string $mode [None|Story|Strike|Raid|AllPvP|Patrol|AllPvE|PvPIntroduction|ThreeVsThree|Control|Lockdown|Team|FreeForAll|Nightfall|Heroic|AllStrikes]
	 * @param int $page
	 * @param int $count
	 *
	 * @return \Destiny\DestinyRequest
	 */
	public function statsActivityHistory(Character $character, $mode, $page = 0, $count = 25)
	{
		$membershipType = $character->membershipType;
		$membershipId = $character->membershipId;
		$characterId = $character->characterId;

		$uri    = "destiny/stats/activityhistory/$membershipType/$membershipId/$characterId/";
		$params = ['mode' => $mode, 'count' => $count, 'page' => $page, 'definitions' => 'false'];

		return $this->request($uri, $params, CACHE_DEFAULT);
	}

	public function statsActivityAggregated(Character $character)
	{
		$membershipType = $character->membershipType;
		$membershipId = $character->membershipId;
		$characterId = $character->characterId;

		return $this->request("destiny/stats/aggregateactivitystats/$membershipType/$membershipId/$characterId/", CACHE_DEFAULT);
	}
}
