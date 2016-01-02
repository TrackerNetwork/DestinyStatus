<?php namespace Destiny;

use Illuminate\Support\Collection;

/**
 * @method Character offsetGet($key)
 */
class CharacterCollection extends Collection
{
	public function __construct(Account $account, array $items = [])
	{
		foreach ($items as $properties)
		{
			$character = new Character($account, $properties);
			$this->items[$character->characterId] = $character;
		}
	}
}
