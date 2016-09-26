<?php namespace Destiny\Grimoire;

use Destiny\Collection;

/**
 * @method \Destiny\Grimoire\Rank offsetGet($key)
 */
class RankCollection extends Collection
{
	public function __construct(Statistic $statistic, array $items = null)
	{
		if (is_array($items))
		{
			$offset = 0;
			foreach ($items as $properties)
			{
				$properties['offset'] = $offset;
				$offset = $properties['threshold'];

				$rank = new Rank($statistic, $properties);
				$this->items[$rank->rank] = $rank;
			}
		}
	}
}
