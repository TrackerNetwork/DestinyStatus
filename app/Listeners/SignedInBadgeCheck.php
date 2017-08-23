<?php

namespace App\Listeners;

use App\Events\BungieSignedIn;
use App\Helpers\BadgeHelper;
use App\Models\AssignedBadge;
use App\Models\Badge;


class SignedInBadgeCheck
{
    /**
     * The events handled by the listener.
     *
     * @var array
     */
    public static $listensFor = [
        BungieSignedIn::class,
    ];

    /**
     * SignedInBadgeCheck constructor.
     */
    public function __construct()
    {
        //
    }

    /**
     * @param BungieSignedIn $event
     */
    public function handle(BungieSignedIn $event)
    {
        /** @var Badge $confirmed */
        $confirmed = Badge::query()->where('slug', 'confirmed')->first();

        if (! AssignedBadge::query()
            ->where('account_id', $event->bungie->account_id)
            ->where('badge_id', $confirmed->id)
            ->exists())
        {
            BadgeHelper::grantBadge($confirmed, $event->bungie->account);
        }
    }
}
