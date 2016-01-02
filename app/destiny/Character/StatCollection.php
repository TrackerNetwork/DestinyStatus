<?php namespace Destiny\Character;

use Destiny\Collection;

class StatCollection extends Collection
{
	public function __construct(array $items = [])
	{
		foreach ($items as $item)
		{
			$stat = new Stat($item);
			$this->put($stat->statIdentifier, $stat);
		}
	}
}
