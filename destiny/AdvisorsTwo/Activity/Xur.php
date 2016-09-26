<?php namespace Destiny\AdvisorsTwo\Activity;

use Destiny\Advisors;
use Destiny\AdvisorsTwo\Activity;

/**
 * @property string $progressionHash
 * @property \Destiny\Xur $xur
 */
class Xur extends Activity implements ActivityInterface, EventInterface
{
	public function __construct(Advisors $advisors, array $properties)
	{
		if ($properties['status']['active'])
		{
			$vendorXur = destiny()->xur();
			$properties['xur'] = $vendorXur;
		}
		parent::__construct($properties);
	}

	protected function gWeapons()
	{
		return $this->xur->weapons;
	}

	/**
	 * @return string
	 */
	public function getTitle()
	{
		return 'Xur';
	}

	/**
	 * @return string
	 */
	public static function getIdentifier()
	{
		return 'xur';
	}
}