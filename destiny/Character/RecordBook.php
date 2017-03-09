<?php namespace Destiny\Character;

use Destiny\Character;
use Destiny\Model;

/**
 * @property string $bookHash
 * @property int $completedCount
 * @property int $redeemedCount
 * @property array $records
 * @property array $progression
 * @property array $spotlights
 */
class RecordBook extends Model
{

	/**
	 * @var \Destiny\Character
	 */
	protected $character;

	public function __construct(Character $character, array $properties)
	{
		$definition = manifest()->recordBook($properties['bookHash']);
		$properties = array_merge($properties, $definition->getProperties());

		parent::__construct($properties);
		$this->character = $character;
	}
}
