<?php

declare(strict_types=1);

namespace App\Helpers;

use App\Account;
use App\Models\AssignedBadge;
use App\Models\Badge;

/**
 * Class BadgeHelper.
 */
class BadgeHelper
{
    /**
     * @param Badge   $badge
     * @param Account $account
     *
     * @return bool
     */
    public static function grantBadge(Badge $badge, Account $account): bool
    {
        $badge = new AssignedBadge([
            'badge_id'   => $badge->id,
            'account_id' => $account->id,
        ]);

        return $badge->save();
    }
}
