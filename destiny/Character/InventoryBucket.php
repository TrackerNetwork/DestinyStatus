<?php namespace Destiny\Character;

use Destiny\Model;

/**
 * @property string $bucketHash
 * @property \Destiny\Character\InventoryItemCollection $items
 *
 * @property string $bucketName
 * @property string $bucketDescription
 * @property string $bucketIdentifier
 * @property int $bucketOrder
 *
 * @property \Destiny\Character\InventoryItem $equipped
 * @property \Destiny\Definitions\InventoryBucket $definition
 */
class InventoryBucket extends Model
{
	/**
	 * @var \Destiny\Character\Inventory
	 */
	protected $inventory;

	public function __construct(Inventory $inventory, array $properties)
	{
		parent::__construct($properties);
		$this->inventory = $inventory;
	}

	protected function gDefinition()
	{
		return manifest()->inventoryBucket($this->bucketHash);
	}

	protected function gItems(array $items)
	{
		$collection = new InventoryItemCollection;

		foreach ($items as $properties)
		{
			$item = new InventoryItem($this, $properties);
			$collection->put($item->itemHash, $item);
		}

		return $collection;
	}

	protected function gEquipped()
	{
		return $this->items->first(function($hash, InventoryItem $item)
		{
			return $item->isEquipped;
		});
	}

	protected function gBucketHash($value)
	{
		return (string) $value;
	}

	protected function gBucketName()
	{
		return $this->definition->bucketName;
	}

	protected function gBucketDescription()
	{
		return $this->definition->bucketDescription;
	}

	protected function gBucketIdentifier()
	{
		return $this->definition->bucketIdentifier;
	}

	protected function gBucketOrder()
	{
		return $this->definition->bucketOrder;
	}
}
