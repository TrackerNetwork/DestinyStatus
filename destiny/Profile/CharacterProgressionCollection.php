<?php

declare(strict_types=1);

namespace Destiny\Profile;

use App\Enums\PrivacySetting;
use Destiny\Collection;
use Destiny\Profile\Progression\FactionCollection;
use Destiny\Profile\Progression\MilestoneCollection;
use Destiny\Profile\Progression\ProgressionCollection;
use Destiny\Profile\Progression\QuestCollection;
use Destiny\Profile\Progression\UninstancedItemObjectiveCollection;

/**
 * Class CharacterProgressionCollection.
 *
 * @package Destiny\Profile
 */
class CharacterProgressionCollection extends Collection
{
    public function __construct(array $properties)
    {
        $characters = [];

        if ($properties['privacy'] != PrivacySetting::Private)
        {

            foreach ($properties['data'] as $characterId => $progressions)
            {
                $character['progression'] = new ProgressionCollection($progressions['progressions']);
                $character['faction'] = new FactionCollection($progressions['factions']);
                $character['milestone'] = new MilestoneCollection($progressions['milestones']);
                $character['quest'] = new QuestCollection($progressions['quests']);
                $character['objective'] = new UninstancedItemObjectiveCollection($progressions['uninstancedItemObjectives']);

                $characters[$characterId] = $character;
            }
        }

        parent::__construct($characters);
    }
}