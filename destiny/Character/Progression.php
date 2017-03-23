<?php

namespace Destiny\Character;

use Destiny\Character;
use Destiny\Model;

/**
 * @property string $dailyProgress
 * @property string $weeklyProgress
 * @property string $currentProgress
 * @property int $level
 * @property int $step
 * @property string $progressToNextLevel
 * @property int $percentToNextLevel
 * @property string $percentLabel
 * @property string $nextLevelAt
 * @property string $progressionHash
 * @property string $name
 * @property string $scope
 * @property string $repeatLastStep
 * @property string $icon
 * @property string $identifier
 * @property string $description
 * @property string $source
 * @property array $steps
 * @property string $label
 */
class Progression extends Model
{
    const PRESTIGE = 'character_prestige';
    const WEEKLY_PVE = 'weekly_pve';
    const WEEKLY_PVP = 'weekly_pvp';
    const CRYPTARCH = 'faction_cryptarch';
    const IRON_BANNER = 'faction_event_iron_banner';
    const VANGUARD = 'faction_fotc_vanguard';
    const CRUCIBLE = 'faction_pvp';
    const DEAD_ORBIT = 'faction_pvp_dead_orbit';
    const NEW_MONARCHY = 'faction_pvp_new_monarchy';
    const FUTURE_WAR_CULT = 'faction_pvp_future_war_cult';
    const ERIS_MORN = 'faction_eris';
    const HOUSE_OF_JUDGMENT = 'r1_s3_factions_fallen';
    const QUEEN = 'r1_s3_factions_queen';
    const TOS_WINS = 'r1_s3_tickets.pvp.trials_of_osiris.wins';
    const TOS_LOSSES = 'r1_s3_tickets.pvp.trials_of_osiris.losses';
    const GUNSMITH = 'r1_s4_factions_gunsmith';
    const SRL = 'r1_s4_pvp_racing';

    protected $names = [
        self::WEEKLY_PVE        => 'Weekly Vanguard Marks',
        self::WEEKLY_PVP        => 'Weekly Crucible Marks',
        self::PRESTIGE          => 'Mote of Light',
        self::CRYPTARCH         => 'Cryptarch',
        self::VANGUARD          => 'Vanguard',
        self::ERIS_MORN         => 'Crota\'s Bane',
        self::CRUCIBLE          => 'Crucible',
        self::DEAD_ORBIT        => 'Dead Orbit',
        self::NEW_MONARCHY      => 'New Monarchy',
        self::FUTURE_WAR_CULT   => 'Future War Cult',
        self::QUEEN             => 'Queen\'s Wrath',
        self::IRON_BANNER       => 'Iron Banner',
        self::HOUSE_OF_JUDGMENT => 'House of Judgment',
        self::GUNSMITH          => 'Gunsmith',
        self::SRL               => 'SRL',
    ];

    /**
     * @var \Destiny\Character
     */
    protected $character;

    public function __construct(Character $character, array $properties)
    {
        $definition = manifest()->progression($properties['progressionHash']);
        $properties = array_merge($properties, $definition->getProperties());

        parent::__construct($properties);
        $this->character = $character;

        if ($this->name == self::WEEKLY_PVE || $this->name == self::WEEKLY_PVP) {
            if (!$character->playedAfterWeeklyReset) {
                $this->level = 0;
            }

            $this->nextLevelAt = count($this->steps);
            $this->progressToNextLevel = $this->level;
        }

        $this->percentToNextLevel = $this->nextLevelAt ? ($this->progressToNextLevel / $this->nextLevelAt * 100) : 100;
        $this->percentLabel = sprintf('%d / %d', $this->progressToNextLevel, $this->nextLevelAt);

        if ($this->isMaxed()) {
            $this->percentToNextLevel = 100;
            $this->percentLabel = 'MAX';
        }
    }

    protected function gProgressionHash($value)
    {
        return (string) $value;
    }

    protected function gIcon($value)
    {
        return $value ?: '/img/misc/missing_icon.png';
    }

    protected function gLabel()
    {
        return array_get($this->names, $this->name, $this->name);
    }

    public function isMaxed()
    {
        return !$this->nextLevelAt;
    }
}
