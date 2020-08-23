<?php

namespace App\Enums;

/**
 * Class MergeMethod.
 */
abstract class MergeMethod
{
    /**
     * When collapsing multiple instances of the stat together, add the values.
     */
    const ADD = 0;

    /**
     * When collapsing multiple instances of the stat together, take the lower value.
     */
    const MIN = 1;

    /**
     * When collapsing multiple instances of the stat together, take the higher value.
     */
    const MAX = 2;
}
