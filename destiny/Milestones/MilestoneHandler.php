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
    public function __construct(array $properties)
    {
        $properties['milestones'] = new MilestoneCollection($properties['milestones']);
        parent::__construct($properties);
    }

    public function gWeeklys()
    {
        $weeklys = [];
        foreach ($this->milestones as $milestone) {
            if ($milestone->milestone->milestoneType == MilestoneType::Weekly) {
                if (!str_contains($milestone->milestone->friendlyName, 'Clan')) {
                    $weeklys[] = $milestone;
                }
            }
        }

        return $weeklys;
    }
}
