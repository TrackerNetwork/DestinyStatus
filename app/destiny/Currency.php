<?php namespace Destiny;

use Destiny\Definitions\InventoryItem as InventoryItemDefinition;

/**
 * @property int $value
 *
 * {@inheritDoc}
 */
class Currency extends InventoryItemDefinition
{
	public function __construct(array $properties)
	{
		$definition = manifest()->inventoryItem($properties['itemHash']);
		$properties = array_merge($definition->getProperties(), $properties);

		parent::__construct($properties);
	}
}
