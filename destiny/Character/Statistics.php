<?php namespace Destiny\Character;

use Destiny\Model;
use Destiny\Character;
use Destiny\StatisticsCollection;

/**
 * @property \Destiny\Character $character
 * @property \Destiny\StatisticsCollection $total
 * @property \Destiny\StatisticsCollection $pve
 * @property \Destiny\StatisticsCollection $pvp
 */
class Statistics extends Model
{
	protected $character;

	public function __construct(Character $character, array $properties)
	{
		parent::__construct($properties);
		$this->character = $character;
	}

	protected function gCharacter()
	{
		return $this->character;
	}

	protected function gTotal()
	{
		return new StatisticsCollection(array_get($this->properties, 'merged.allTime', []));
	}

	protected function gPve()
	{
		return new StatisticsCollection(array_get($this->properties, 'results.allPvE.allTime', []));
	}

	protected function gPvp()
	{
		return new StatisticsCollection(array_get($this->properties, 'results.allPvP.allTime', []));
	}
}
