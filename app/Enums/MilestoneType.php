<?php

namespace App\Enums;

/**
 * Class MilestoneType
 * @package App\Enums
 */
abstract class MilestoneType
{
    const Unknown = 0;

    /**
     * One-time milestones that are specifically oriented toward teaching players about new mechanics and
     * gameplay modes.
     */
    const Tutorial = 1;

    /**
     * Milestones that, once completed a single time, can never be repeated.
     */
    const OneTime = 2;

    /**
     * Milestones that repeat/reset on a weekly basis. They need not all reset on the
     * same day or time,but do need to reset weekly to qualify for this type.
     */
    const Weekly = 3;

    /**
     * Milestones that repeat or reset on a daily basis.
     */
    const Daily = 4;

    /**
     * Special indicates that the event is not on a daily/weekly cadence,
     * but does occur more than once.For instance, Iron Banner in Destiny 1 or
     * the Dawning were examples of what could be termed "Special"events.
     */
    const Special = 5;
}
