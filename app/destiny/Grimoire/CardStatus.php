<?php namespace Destiny\Grimoire;

use Destiny\Grimoire;

/**
 * @property string $cardId
 * @property int $score
 * @property int $points
 * @property \Destiny\Collection $statisticCollection
 * @property null $ackState
 */
class CardStatus extends Model
{
	protected function gStatisticCollection()
	{
		$statisticCollection = $this->newCollection();

		if ( ! isset($this->properties['statisticCollection']))
		{
			return $statisticCollection;
		}

		foreach ($this->properties['statisticCollection'] as $statistic)
		{
			$rankCollection = $this->newCollection();
			foreach (array_get($statistic, 'rankCollection') ?: [] as $rank)
			{
				$rankCollection->put($rank['rank'], $rank);
			}
			$statistic['rankCollection'] = $rankCollection;
			$statisticCollection->put($statistic['statNumber'], $statistic);
		}

		return $statisticCollection;
	}
}
