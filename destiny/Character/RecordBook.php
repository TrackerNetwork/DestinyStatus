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

		// @todo - In the future expand this to Collections for Pages/Records
		foreach ($properties['pages'] as $pageId => $page) {
			if (count($page['records']) > 0) {
				foreach ($page['records'] as $recordId => $record) {
					$definition = manifest()->record($record['recordHash']);
					$record = array_merge($record, $definition->getProperties());

					if (isset($properties['records'][$record['recordHash']])) {
						$record = array_merge($record, $properties['records'][$record['recordHash']]);
					}

					$properties['pages'][$pageId]['records'][$recordId] = $record;
				}
			}

			if (count($page['rewards']) > 0) {
				foreach ($page['rewards'] as $rewardId => $reward) {
					$definition = manifest()->inventoryItem($reward['itemHash']);
					$reward = array_merge($reward, $definition->getProperties());

					$properties['pages'][$pageId]['rewards'][$rewardId] = $reward;
				}
			}
		}
		parent::__construct($properties);
		$this->character = $character;
	}
}
