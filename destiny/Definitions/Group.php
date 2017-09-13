<?php

namespace Destiny\Definitions;

use Destiny\Definitions\Common\DisplayProperties;

/**
 * Class Group.
 * @property array $detail
 * @property array $founder
 * @property array $alliedIds
 * @property int $allianceStatus
 * @property int $groupJoinInviteCount
 * @property array $currentUserMemberMap
 * @property array $currentUserPotentialMemberMap
 */
class Group extends Definition
{
    protected $appends = [
    ];
}
