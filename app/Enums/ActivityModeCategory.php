<?php

namespace App\Enums;

/**
 * Class ActivityModeCategory.
 */
abstract class ActivityModeCategory
{
    /**
     * Activities that are neither PVP nor PVE, such as social activities.
     */
    const NONE = 0;

    /**
     * PvE activities, where you shoot aliens in the face.
     */
    const PVE = 1;

    /**
     * PvP activities, where you teabag other humans in the face.
     */
    const PVP = 2;
}
