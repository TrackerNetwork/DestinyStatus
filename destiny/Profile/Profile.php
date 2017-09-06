<?php

declare(strict_types=1);

namespace Destiny\Profile;

use Destiny\Definitions\Components\Profile as ProfileDefinition;

/**
 * Class Profile.
 */
class Profile extends ProfileDefinition
{
    public function __construct(array $properties)
    {
        parent::__construct($properties['data']);
    }
}
