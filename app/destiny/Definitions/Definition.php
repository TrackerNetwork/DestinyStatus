<?php namespace Destiny\Definitions;

use Destiny\Model;

class Definition extends Model
{
	public function __construct(array $definition = null)
	{
		$this->properties = $definition ?: [];
	}

	protected function extend(Definition $definition)
	{
		$this->properties = array_merge($this->properties, $definition->properties);
		$this->cached = array_merge($this->cached, $definition->cached);
	}
}
