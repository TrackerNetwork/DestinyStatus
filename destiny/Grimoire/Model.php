<?php

namespace Destiny\Grimoire;

use Destiny\Grimoire;
use Destiny\Model as DestinyModel;

/**
 * @property \Destiny\Grimoire $grimoire
 */
class Model extends DestinyModel
{
    protected $grimoire;

    public function __construct(Grimoire $grimoire, array $properties)
    {
        parent::__construct($properties);
        $this->grimoire = $grimoire;
    }

    protected function gGrimoire()
    {
        return $this->grimoire;
    }
}
