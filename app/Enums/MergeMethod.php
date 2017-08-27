<?php

namespace App\Enums;

/**
 * Class MergeMethod
 * @package App\Enums
 */
abstract class MergeMethod
{
    /**
     * When collapsing multiple instances of the stat together, add the values.
     */
    const Add = 0;

    /**
     * When collapsing multiple instances of the stat together, take the lower value.
     */
    const Min = 1;

    /**
     * When collapsing multiple instances of the stat together, take the higher value.
     */
    const Max = 2;
}
