<?php

namespace Destiny\AdvisorsTwo;

use Destiny\Model;

/**
 * @property bool $complete
 * @property bool $success
 */
class Completion extends Model
{
    public function __construct(array $properties)
    {
        parent::__construct($properties);
    }
}
