<?php namespace Destiny\Advisors;

use Destiny\Model;

/**
 * @property string $eventHash
 * @property string $eventIdentifier
 * @property \Carbon\Carbon $expirationDate
 * @property \Carbon\Carbon $startDate
 * @property bool $expirationKnown
 *
 * @property string $backgroundImageWeb
 * @property string $title
 * @property string $subtitle
 * @property string $link
 * @property string $icon
 * @property string $progressionHash
 * @property string $vendorHash
 *
 * @property int $minutesUntilExpiration
 */
class Event extends Model
{
	public function __construct(array $properties)
	{
		$definition = manifest()->specialEvent($properties['eventHash']);
		$properties = array_merge($properties, $definition->getProperties());

		parent::__construct($properties);
	}

	protected function gExpirationDate()
	{
		return carbon($this->properties['expirationDate']);
	}

	protected function gStartDate()
	{
		return carbon($this->properties['startDate']);
	}

	protected function gMinutesUntilExpiration()
	{
		return $this->expirationDate->diffInMinutes();
	}

	public function isActive()
	{
		if ( ! $this->expirationKnown)
		{
			return true;
		}

		return ! $this->expirationDate->isPast();
	}
}
