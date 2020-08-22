<?php

namespace App\Listeners;

use App\Events\BungieSignedIn;
use App\Helpers\BadgeHelper;
use App\Models\AssignedBadge;
use App\Models\Badge;

class SignedInBadgeCheck
{
    public static $listensFor = [
        BungieSignedIn::class,
    ];

    public function handle(BungieSignedIn $event)
    {
        /** @var Badge $confirmed */
        $confirmed = Badge::query()->where('slug', 'confirmed')->first();

        foreach ($event->bungie->accounts as $account) {
            if (!AssignedBadge::query()
                ->where('account_id', $account->id)
                ->where('badge_id', $confirmed->id)
                ->exists()) {
                BadgeHelper::grantBadge($confirmed, $account);
            }
        }
    }
}
