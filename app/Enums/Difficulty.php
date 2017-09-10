<?php

namespace App\Enums;

/**
 * Class ActivityModeType.
 */
abstract class Difficulty
{
    const Trivial = 0; // Normal

    const Easy = 1;

    const Normal = 2; // Prestige

    const Challenging = 3;

    const Hard = 4;

    const Brave = 5;

    const AlmostImpossible = 6;

    const Impossible = 7;
}
