<?php namespace Destiny;

use Illuminate\Support\Collection;

/**
 * @method \Destiny\Player offsetGet($key)
 */
class PlayerCollection extends Collection
{
	public function __construct(array $items)
	{
		foreach ($items as $properties)
		{
			$player = new Player($properties);
			$this->items[$player->platform] = $player;
		}
	}
}
