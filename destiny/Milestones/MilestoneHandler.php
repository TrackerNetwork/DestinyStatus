<?php

declare(strict_types=1);

namespace Destiny\Milestones;

use App\Enums\MilestoneType;
use Destiny\Definitions\PublicMilestone;
use Destiny\Model;

/**
 * Class Player.
 *
 * @property MilestoneCollection $milestones
 * @property-read PublicMilestone $weeklys
 */
class MilestoneHandler extends Model
{
    const HASH_NIGHTFALL = '2171429505';
    const HASH_MEDITATIONS = '3245985898';
    const HASH_LEVIATHAN = '3660836525';

    public function __construct(array $properties)
    {
        $properties['milestones'] = new MilestoneCollection($properties['milestones']);
        parent::__construct($properties);
    }

    public function gWeeklys()
    {
        $allowed = [self::HASH_NIGHTFALL, self::HASH_MEDITATIONS, self::HASH_LEVIATHAN];

        $weeklys = [];
        foreach ($this->milestones as $milestone) {
            if (in_array($milestone->milestoneHash, $allowed)) {
                $weeklys[] = $milestone;
            }
        }

        return $weeklys;
    }
}
