<?php namespace Destiny\Character;

use Destiny\Model;

/**
 * @property string $perkHash
 * @property string $iconPath
 * @property bool $isActive
 *
 * @property \Destiny\Definitions\SandboxPerk $definition
 */
class Perk extends Model
{
	protected $definition;

	public function __construct(array $properties)
	{
		parent::__construct($properties);
		$this->definition = manifest()->sandboxPerk($this->perkHash);
	}

	protected function gDefinition()
	{
		return $this->definition;
	}
}
