<?php

namespace Destiny;

use Cache;

class DestinyManifest
{
    /**
     * @var array
     */
    protected static $instances = [];

    /**
     * @param string $type
     * @param string $key
     *
     * @return array|null
     */
    protected function load($type, $key)
    {
        $cacheKey = "$type:$key";

        $json = Cache::rememberForever($cacheKey, function () use ($type, $key) {
            $definition = base_path("database/manifest/$type/$key.php");

            if (is_file($definition)) {
                return require $definition;
            }
        });

        if (empty($json)) {
            Cache::forget($cacheKey);
        }

        return $json;
    }

    protected function instance($type, $key)
    {
        $key = (string) $key;
        $instance = array_get(static::$instances, "$type.$key");

        if (!$instance) {
            $namespace = '\\Destiny\\Definitions\\';
            $class = array_get(['Class' => 'CharacterClass'], $type, $type);

            $className = $namespace.$class;
            $instance = new $className($this->load($type, $key));

            static::$instances[$class][$key] = $instance;
        }

        return $instance;
    }

    /**
     * @param string $hash
     *
     * @return \Destiny\Definitions\ActivityBundle
     */
    public function activityBundle($hash)
    {
        return $this->instance('ActivityBundle', $hash);
    }

    /**
     * @param string $hash
     *
     * @return \Destiny\Definitions\Activity
     */
    public function activity($hash)
    {
        return $this->instance('Activity', $hash);
    }

    /**
     * @param string $hash
     *
     * @return \Destiny\Definitions\ActivityType
     */
    public function activityType($hash)
    {
        return $this->instance('ActivityType', $hash);
    }

    /**
     * @param string $hash
     *
     * @return \Destiny\Definitions\CharacterClass
     */
    public function characterClass($hash)
    {
        return $this->instance('Class', $hash);
    }

    /**
     * @param string $hash
     *
     * @return \Destiny\Definitions\Combatant
     */
    public function combatant($hash)
    {
        return $this->instance('Combatant', $hash);
    }

    /**
     * @param string $hash
     *
     * @return \Destiny\Definitions\Destination
     */
    public function destination($hash)
    {
        return $this->instance('Destination', $hash);
    }

    /**
     * @param string $hash
     *
     * @return \Destiny\Definitions\DirectorBook
     */
    public function directorBook($hash)
    {
        return $this->instance('DirectorBook', $hash);
    }

    /**
     * @param string $hash
     *
     * @return \Destiny\Definitions\EnemyRace
     */
    public function enemyRace($hash)
    {
        return $this->instance('EnemyRace', $hash);
    }

    /**
     * @param string $hash
     *
     * @return \Destiny\Definitions\Faction
     */
    public function faction($hash)
    {
        return $this->instance('Faction', $hash);
    }

    /**
     * @param string $hash
     *
     * @return \Destiny\Definitions\Gender
     */
    public function gender($hash)
    {
        return $this->instance('Gender', $hash);
    }

    /**
     * @param string $cardId
     *
     * @return \Destiny\Definitions\GrimoireCard
     */
    public function grimoireCard($cardId)
    {
        return $this->instance('GrimoireCard', $cardId);
    }

    /**
     * @return \Destiny\Definitions\Grimoire
     */
    public function grimoire()
    {
        return $this->instance('Grimoire', '0');
    }

    /**
     * @param string $key
     *
     * @return \Destiny\Definitions\HistoricalStats
     */
    public function historicalStats($key)
    {
        return $this->instance('HistoricalStats', $key);
    }

    /**
     * @param string $hash
     *
     * @return \Destiny\Definitions\InventoryBucket
     */
    public function inventoryBucket($hash)
    {
        return $this->instance('InventoryBucket', $hash);
    }

    /**
     * @param string $hash
     *
     * @return \Destiny\Definitions\InventoryItem
     */
    public function inventoryItem($hash)
    {
        return $this->instance('InventoryItem', $hash);
    }

    /**
     * @param string $hash
     *
     * @return \Destiny\Definitions\Place
     */
    public function place($hash)
    {
        return $this->instance('Place', $hash);
    }

    /**
     * @param string $hash
     *
     * @return \Destiny\Definitions\Progression
     */
    public function progression($hash)
    {
        return $this->instance('Progression', $hash);
    }

    /**
     * @param string $hash
     *
     * @return \Destiny\Definitions\Objective
     */
    public function objective($hash)
    {
        return $this->instance('Objective', $hash);
    }

    /**
     * @param string $hash
     *
     * @return \Destiny\Definitions\Race
     */
    public function race($hash)
    {
        return $this->instance('Race', $hash);
    }

    /**
     * @param string $hash
     *
     * @return \Destiny\Definitions\SandboxPerk
     */
    public function sandboxPerk($hash)
    {
        return $this->instance('SandboxPerk', $hash);
    }

    /**
     * @param string $hash
     *
     * @return \Destiny\Definitions\ScriptedSkull
     */
    public function scriptedSkull($hash)
    {
        return $this->instance('ScriptedSkull', $hash);
    }

    /**
     * @param string $hash
     *
     * @return \Destiny\Definitions\SpecialEvent
     */
    public function specialEvent($hash)
    {
        return $this->instance('SpecialEvent', $hash);
    }

    /**
     * @param string $hash
     *
     * @return \Destiny\Definitions\Stat
     */
    public function stat($hash)
    {
        return $this->instance('Stat', $hash);
    }

    /**
     * @param $hash
     *
     * @return \Destiny\Definitions\RecordBook
     */
    public function recordBook($hash)
    {
        return $this->instance('RecordBook', $hash);
    }

    /**
     * @param $hash
     *
     * @return \Destiny\Definitions\Record
     */
    public function record($hash)
    {
        return $this->instance('Record', $hash);
    }

    /**
     * @param string $hash
     *
     * @return \Destiny\Definitions\StatGroup
     */
    public function statGroup($hash)
    {
        return $this->instance('StatGroup', $hash);
    }

    /**
     * @param string $hash
     *
     * @return \Destiny\Definitions\TalentGrid
     */
    public function talentGrid($hash)
    {
        return $this->instance('TalentGrid', $hash);
    }

    /**
     * @param string $hash
     *
     * @return \Destiny\Definitions\UnlockFlag
     */
    public function unlockFlag($hash)
    {
        return $this->instance('UnlockFlag', $hash);
    }

    /**
     * @param string $hash
     *
     * @return \Destiny\Definitions\Vendor
     */
    public function vendor($hash)
    {
        return $this->instance('Vendor', $hash);
    }
}
