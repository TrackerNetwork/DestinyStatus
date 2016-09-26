<?php namespace Destiny\AdvisorsTwo;

use Destiny\Model;

/**
 * @property string $message
 */
class Tip extends Model
{
	public function __construct(array $properties)
	{
		parent::__construct($properties);
	}
}