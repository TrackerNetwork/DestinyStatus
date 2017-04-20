<?php

namespace Destiny\AdvisorsTwo\Activity;

use Destiny\Advisors;
use Destiny\AdvisorsTwo\Activity;

/**
 * @property string $progressionHash
 * @property \Destiny\Xur $xur
 */
class Xur extends Activity implements ActivityInterface, EventInterface
{
    public function __construct(array $items, array $properties)
    {
        if ($properties['status']['active']) {
            try {
                $vendorXur = destiny()->xur();
                $properties['xur'] = $vendorXur;
            } catch (\Exception $e) {
                $properties['xur'] = new \Destiny\Xur([]);
            }
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
