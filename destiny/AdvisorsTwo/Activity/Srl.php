<?php

namespace Destiny\AdvisorsTwo\Activity;

use Destiny\AdvisorsTwo\Activity;

/**
 * @property string $progressionHash
 */
class Srl extends Activity implements ActivityInterface
{
    public function __construct(array $items, array $properties)
    {
        parent::__construct($properties);
    }

    /**
     * @return string
     */
    public static function getIdentifier()
    {
        return 'srl';
    }

    public function isEventCancelled()
    {
        return true;
    }
}
