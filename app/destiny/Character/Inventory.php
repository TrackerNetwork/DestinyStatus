<?php namespace Destiny\Character;

use Destiny\Model;
use Destiny\Character;

/**
 * @property \Destiny\Character\InventoryBucket[] $buckets
 *
 * @property \Destiny\Character\InventoryBucket $subclass
 * @property \Destiny\Character\InventoryBucket $primaryWeapons
 * @property \Destiny\Character\InventoryBucket $specialWeapons
 * @property \Destiny\Character\InventoryBucket $heavyWeapons
 * @property \Destiny\Character\InventoryBucket $head
 * @property \Destiny\Character\InventoryBucket $arms
 * @property \Destiny\Character\InventoryBucket $chest
 * @property \Destiny\Character\InventoryBucket $legs
 * @property \Destiny\Character\InventoryBucket $vehicle
 * @property \Destiny\Character\InventoryBucket $ship
 * @property \Destiny\Character\InventoryBucket $ghost
 * @property \Destiny\Character\InventoryBucket $shader
 * @property \Destiny\Character\InventoryBucket $emblem
 * @property \Destiny\Character\InventoryBucket $emote
 * @property \Destiny\Character\InventoryBucket $artifact
 *
 * @property \Destiny\Character $character
 * @property \Destiny\Account $account
 */
class Inventory extends Model
{
	const BUCKET_SUBCLASS        = '3284755031';
	const BUCKET_PRIMARY_WEAPONS = '1498876634';
	const BUCKET_SPECIAL_WEAPONS = '2465295065';
	const BUCKET_HEAVY_WEAPONS   = '953998645';
	const BUCKET_HEAD            = '3448274439';
	const BUCKET_ARMS            = '3551918588';
	const BUCKET_CHEST           = '14239492';
	const BUCKET_LEGS            = '20886954';
	const BUCKET_CLASS           = '1585787867';
	const BUCKET_GHOST           = '4023194814';
	const BUCKET_VEHICLES        = '2025709351';
	const BUCKET_SHIPS           = '284967655';
	const BUCKET_SHADERS         = '2973005342';
	const BUCKET_EMBLEMS         = '4274335291';
	const BUCKET_EMOTES          = '3054419239';
	const BUCKET_ARTIFACTS       = '434908299';

	/**
	 * @var \Destiny\Character
	 */
	protected $character;

	public function __construct(Character $character, array $properties)
	{
		$items = [];
		foreach(array_get($properties, 'items', null) as $property)
		{
			$hash = (string) $property['itemHash'];
			$definition = manifest()->inventoryItem($hash);
			$property = array_merge($property, $definition->getProperties());

			$items['buckets'][$property['bucketHash']] = new InventoryItem(new InventoryBucket($this, $properties), $property);
		}

		parent::__construct($items);
		$this->character = $character;
	}

	protected function gCharacter()
	{
		return $this->character;
	}

	protected function gAccount()
	{
		return $this->character->account;
	}

	protected function gSubclass()
	{
		return $this->buckets[self::BUCKET_SUBCLASS];
	}

	protected function gPrimaryWeapons()
	{
		return $this->buckets[self::BUCKET_PRIMARY_WEAPONS];
	}

	protected function gSpecialWeapons()
	{
		return $this->buckets[self::BUCKET_SPECIAL_WEAPONS];
	}

	protected function gHeavyWeapons()
	{
		return $this->buckets[self::BUCKET_HEAVY_WEAPONS];
	}

	protected function gHead()
	{
		return $this->buckets[self::BUCKET_HEAD];
	}

	protected function gArms()
	{
		return $this->buckets[self::BUCKET_ARMS];
	}

	protected function gChest()
	{
		return $this->buckets[self::BUCKET_CHEST];
	}

	protected function gLegs()
	{
		return $this->buckets[self::BUCKET_LEGS];
	}

	protected function gClass()
	{
		return $this->buckets[self::BUCKET_CLASS];
	}

	protected function gVehicle()
	{
		return $this->buckets[self::BUCKET_VEHICLES];
	}

	protected function gShip()
	{
		return $this->buckets[self::BUCKET_SHIPS];
	}

	protected function gGhost()
	{
		return $this->buckets[self::BUCKET_GHOST];
	}

	protected function gShader()
	{
		return $this->buckets[self::BUCKET_SHADERS];
	}

	protected function gEmblem()
	{
		return $this->buckets[self::BUCKET_EMBLEMS];
	}

	protected function gEmote()
	{
		return $this->buckets[self::BUCKET_EMOTES];
	}

	protected function gArtifact()
	{
		return $this->buckets[self::BUCKET_ARTIFACTS];
	}
}
