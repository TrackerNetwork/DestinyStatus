<?php namespace Destiny;

/**
 * @property string $iconPath
 * @property string $membershipType
 * @property string $membershipId
 * @property string $displayName
 *
 * @property string $platform
 * @property string $platformName
 * @property string $platformIcon
 * @property string $clanName
 * @property string $url
 *
 * @property \Destiny\Account $account
 * @property \Destiny\Account $accountExtended
 * @property \Destiny\Grimoire $grimoire
 * @property \Destiny\AccountStatistics $statistics
 */
class Player extends Model
{
	protected function gPlatform()
	{
		return $this->membershipType == 2 ? 'psn' : 'xbl';
	}

	protected function gPlatformName()
	{
		return $this->membershipType == 2 ? 'PlayStation' : 'Xbox';
	}

	protected function gPlatformIcon()
	{
		return $this->membershipType == 2 ? '/img/psn.png' : '/img/xbl.png';
	}

	protected function gUrl()
	{
		return route('account', ['platform' => $this->platform, 'player' => $this->displayName]);
	}

	protected function gMinutesPlayedTotal()
	{
		$minutes = 0;

		foreach ($this->account->characters as $character)
		{
			$minutes += $character->minutesPlayedTotal;
		}

		return $minutes;
	}

	protected function sAccount(Account $account)
	{
		$this->setCachedProperty('account', $account);
	}

	protected function gAccount()
	{
		return destiny()->account($this);
	}

	protected function gClanName()
	{
		return $this->account->clanName;
	}

	protected function gGrimoire()
	{
		return destiny()->grimoire($this);
	}

	protected function gStatistics()
	{
		return $this->accountExtended->statistics;
	}
}
