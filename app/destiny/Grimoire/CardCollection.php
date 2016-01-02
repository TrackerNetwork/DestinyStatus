<?php namespace Destiny\Grimoire;

use Destiny\Collection;

/**
 * @method \Destiny\Grimoire\Card offsetGet($key)
 */
class CardCollection extends Collection
{
	public function __construct(Page $page, array $items)
	{
		foreach ($items as $properties)
		{
			$card = new Card($page, $properties);
			$this->items[$card->cardId] = $card;
		}
	}
}
