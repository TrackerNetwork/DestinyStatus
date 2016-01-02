<?php namespace Destiny\Character;

use Destiny\Definitions\InventoryItem as InventoryItemDefinition;

/**
 * {@inheritDoc}
 *
 * @property int $bindStatus
 * @property bool $isEquipped
 * @property string $itemInstanceId
 * @property int $itemLevel
 * @property int $stackSize
 * @property array $primaryStat
 * @property bool $canEquip
 * @property int $equipRequiredLevel
 * @property string $unlockFlagHashRequiredToEquip
 * @property int $cannotEquipReason
 * @property int $damageType
 * @property int $damageTypeNodeIndex
 * @property int $damageTypeStepIndex
 * @property array $progression
 * @property array $nodes
 * @property bool $useCustomDyes
 * @property array $artRegions
 * @property bool $isEquipment
 * @property bool $isGridComplete
 * @property \Destiny\Character\Perk[] $perks
 * @property int $location
 * @property int $transferStatus
 * @property bool $locked
 * @property bool $lockable
 *
 * @property \Destiny\Character\Stat $lightStat
 * @property int $defenses
 * @property int $damage
 * @property string $damageTypeName
 * @property string $damageTypeIcon
 * @property bool $isClassified
 */
class InventoryItem extends InventoryItemDefinition
{
	const STAT_LIGHT = '2391494160';

	/**
	 * @var array
	 */
	protected $damageTypes = [
		1 => ['name' => 'Kinetic', 'icon' => '/img/kinetic.png'],
		2 => ['name' => 'Arc',     'icon' => '/img/arc.png'],
		3 => ['name' => 'Solar',   'icon' => '/img/solar.png'],
		4 => ['name' => 'Void',    'icon' => '/img/void.png'],
	];

	protected $classified = [
		'4097026463' => [
			'itemName' => 'No Time To Explain',
			'itemTypeName' => 'Pulse Rifle',
			'tierTypeName' => 'Exotic',
		],
	];

	/**
	 * @var \Destiny\Character\InventoryBucket
	 */
	protected $bucket;

	public function __construct(InventoryBucket $bucket, array $properties)
	{
		$hash = (string) $properties['itemHash'];
		$stats = array_get($properties, 'stats') ?: [];
		$definition = manifest()->inventoryItem($hash);
		$properties = array_merge($properties, $definition->getProperties());
		$properties['isClassified'] = ($hash && empty($properties['itemName']));

		if ($properties['isClassified'] && isset($this->classified[$hash]))
		{
			$properties = array_merge($this->classified[$hash], $properties);
		}

		parent::__construct($properties);
		$this->bucket = $bucket;
		$this->stats = new StatCollection($stats);

		/*
		$itemHash = (string) $properties['
}itemHash'];

		if (array_key_exists($itemHash, $this->patchDefinitions))
		{
			$definition = json_decode($this->patchDefinitions[$itemHash], true);
		}
		else
		{
			$definition = array_get($definitions, "items.$itemHash", []);
		}

		if (isset($properties['progression']))
		{
			if ( ! $properties['progression']['progressToNextLevel'] && $properties['progression']['currentProgress'] > 0)
			{
				$properties['progression']['progressToNextLevel'] = $properties['progression']['nextLevelAt'];
			}
		}
		*/
	}

	protected function gIcon($value)
	{
		if ($value) return $value;

		if ( ! $this->isClassified)
		{
			return null;
		}

		return '/common/destiny_content/icons/f0dcc71487f77a69005bec2e3fb6e4e8.jpg';
	}

	protected function gDefinition()
	{
		return manifest()->inventoryItem($this->itemHash);
	}

	protected function gDefense()
	{
		if (empty($this->primaryStat))
		{
			return 0;
		}

		$stat = manifest()->stat($this->primaryStat['statHash']);

		if ($stat->statIdentifier == 'STAT_DEFENSE')
		{
			return $this->primaryStat['value'];
		}

		return 0;
	}

	protected function gDamage()
	{
		if (empty($this->primaryStat))
		{
			return 0;
		}

		$stat = manifest()->stat($this->primaryStat['statHash']);

		if ($stat->statIdentifier == 'STAT_DAMAGE')
		{
			return $this->primaryStat['value'];
		}

		return 0;
	}

	protected function gDamageTypeName()
	{
		return array_get($this->damageTypes, "$this->damageType.name");
	}

	protected function gDamageTypeIcon()
	{
		return array_get($this->damageTypes, "$this->damageType.icon");
	}

	protected function gLightStat()
	{
		$stat = $this->stats->get('STAT_LIGHT');

		if (empty($stat))
		{
			return 0;
		}

		return $stat->value;
	}

	protected function gIsGridComplete()
	{
		return $this->properties['isGridComplete']
		|| ! $this->progression
		|| ($this->progression && ! $this->progression['nextLevelAt']);
	}

	protected function gPercentToNextLevel()
	{
		if ($this->isGridComplete) return 100;

		if ( ! $this->progression['nextLevelAt']) return 100;

		return ($this->progression['progressToNextLevel'] / $this->progression['nextLevelAt'] * 100);
	}

	protected function gProgressionLabel()
	{
		if ($this->isGridComplete) return 'Complete';

		return sprintf('%d / %s',
			$this->progression['progressToNextLevel'],
			$this->progression['nextLevelAt']
		);
	}

	protected function gPerks()
	{
		$collection = $this->newCollection();
		foreach ($this->properties['perks'] as $perk)
		{
			$perk = new Perk($perk);

			$collection->put($perk->perkHash, $perk);
		}

		return $collection;
	}

	/*
	protected function gIsGridComplete()
	{
		return $this->properties['isGridComplete']
		|| ! $this->progression
		|| ($this->progression && ! $this->progression['nextLevelAt']);
	}

	protected function gPerks()
	{
		$perks = $this->newCollection();
		foreach ($this->properties['perks'] as $perk)
		{
			$hash = (string) $perk['perkHash'];
			$data = array_merge($perk, $this->definitions['perks'][$hash]);
			$perk = new Perk($data, $this->definitions);

			$perks->put($hash, $perk);
		}
		return $perks;
	}
	*/
}
