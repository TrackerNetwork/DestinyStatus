<?php namespace Destiny\Character;

use Destiny\Collection;
use Destiny\Character;

/**
 * @method \Destiny\Character\RecordBookCollection offsetGet($key)
 */
class RecordBookCollection extends Collection
{
	const SRL_RECORD_BOOK 		= '0';
	const TRIUMPH_Y2 			= '2175864601';
	const COMPETITIVE_SPIRIT 	= '2225855327';
	const RISE_OF_IRON 			= '3433868304';

	public function __construct(Character $character, array $properties)
	{
		foreach ($properties['recordBooks'] as $properties)
		{
			$recordBook = new RecordBook($character, $properties);
			$this->put($recordBook->bookHash, $recordBook);
		}
	}
}
