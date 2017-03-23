<?php

namespace Destiny\AdvisorsTwo;

use Carbon\Carbon;
use Destiny\Model;

/**
 * @property bool $expirationKnown
 * @property bool $active
 * @property Carbon $expirationDate
 * @property Carbon $startDate
 */
class Status extends Model
{
    public function __construct(array $properties)
    {
        parent::__construct($properties);
    }

    protected function gExpirationDate($value)
    {
        return carbon($value);
    }

    protected function gStartDate($value)
    {
        return carbon($value);
    }
}
