<?php

namespace Destiny\AdvisorsTwo;

use Destiny\Definitions\SkullModifier;
use Destiny\Model;

/**
 * @property string $enemyRaceHash
 * @property SkullModifier[] $skulls
 * @property string $bossCombatantHash
 * @property int $bossLightLevel
 * @property int $roundNumber
 * @property \Destiny\Definitions\EnemyRace $enemy
 * @property \Destiny\Definitions\Combatant $boss
 */
class ArenaRound extends Model
{
    /**
     * @var SkullModifier[]
     */
    protected $skulls = [];

    public function __construct(ActivityTier $arena, array $properties)
    {
        parent::__construct($properties);

        foreach ($properties['skullCategories'] as $skullCategory) {
            if ($skullCategory['title'] === 'Modifiers') {
                foreach ($skullCategory['skulls'] as $skull) {
                    $skull = new SkullModifier($skull);
                    $this->skulls[] = $skull;
                }
            }
        }
    }

    protected function gSkulls()
    {
        return $this->skulls;
    }

    protected function gEnemy()
    {
        return manifest()->enemyRace($this->enemyRaceHash);
    }

    protected function gBoss()
    {
        return manifest()->combatant($this->bossCombatantHash);
    }
}
