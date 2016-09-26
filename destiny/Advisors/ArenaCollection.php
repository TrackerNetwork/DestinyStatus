<?php namespace Destiny\Advisors;

use Destiny\Collection;

class ArenaCollection extends Collection
{
	public function __construct(array $arenas = [])
	{
		foreach ($arenas as $arena)
		{
			$arena = new Arena($arena);

			$this->put($arena->activityHash, $arena);
		}
	}
}
