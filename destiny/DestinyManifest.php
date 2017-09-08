<?php

namespace Destiny;

use Cache;
use Destiny\Definitions\Manifest\Activity;
use Destiny\Definitions\Manifest\ActivityGraph;
use Destiny\Definitions\Manifest\ActivityMode;
use Destiny\Definitions\Manifest\ActivityModifier;
use Destiny\Definitions\Manifest\ActivityType;
use Destiny\Definitions\Manifest\DamageType;
use Destiny\Definitions\Manifest\Destination;
use Destiny\Definitions\Manifest\DestinyClass;
use Destiny\Definitions\Manifest\Faction;
use Destiny\Definitions\Manifest\Gender;
use Destiny\Definitions\Manifest\HistoricalStat;
use Destiny\Definitions\Manifest\InventoryBucket;
use Destiny\Definitions\Manifest\InventoryItem;
use Destiny\Definitions\Manifest\ItemCategory;
use Destiny\Definitions\Manifest\ItemTierType;
use Destiny\Definitions\Manifest\Location;
use Destiny\Definitions\Manifest\Lore;
use Destiny\Definitions\Manifest\Milestone;
use Destiny\Definitions\Manifest\Objective;
use Destiny\Definitions\Manifest\Place;
use Destiny\Definitions\Manifest\Progression;
use Destiny\Definitions\Manifest\Race;
use Destiny\Definitions\Manifest\RewardSource;
use Destiny\Definitions\Manifest\SandboxPerk;
use Destiny\Definitions\Manifest\SocketType;
use Destiny\Definitions\Manifest\Stat;
use Destiny\Definitions\Manifest\StatGroup;
use Destiny\Definitions\Manifest\TalentGrid;
use Destiny\Definitions\Manifest\Unlock;
use Destiny\Definitions\Manifest\Vendor;

class DestinyManifest
{
    /**
     * @var array
     */
    protected static $instances = [];

    /**
     * @param string $hash
     *
     * @return Activity
     */
    public function activity(string $hash) : Activity
    {
        return $this->instance('Activity', $hash);
    }

    /**
     * @param string $hash
     *
     * @return ActivityGraph
     */
    public function activityGraph(string $hash) : ActivityGraph
    {
        return $this->instance('ActivityGraphs', $hash);
    }

    /**
     * @param string $hash
     *
     * @return ActivityMode
     */
    public function activityMode(string $hash) : ActivityMode
    {
        return $this->instance('ActivityModes', $hash);
    }

    /**
     * @param string $hash
     *
     * @return ActivityModifier
     */
    public function activityModifier(string $hash) : ActivityModifier
    {
        return $this->instance('ActivityModifier', $hash);
    }

    /**
     * @param string $hash
     *
     * @return ActivityType
     */
    public function activityType(string $hash) : ActivityType
    {
        return $this->instance('ActivityTypes', $hash);
    }

    /**
     * @param string $hash
     *
     * @return DestinyClass
     */
    public function destinyClass(string $hash) : DestinyClass
    {
        return $this->instance('Class', $hash);
    }

    /**
     * @param string $hash
     *
     * @return DamageType
     */
    public function damageTypes(string $hash) : DamageType
    {
        return $this->instance('DamageType', $hash);
    }

    /**
     * @param string $hash
     *
     * @return Destination
     */
    public function destination(string $hash) : Destination
    {
        return $this->instance('Destinations', $hash);
    }

    /**
     * @param string $hash
     *
     * @return Faction
     */
    public function faction(string $hash) : Faction
    {
        return $this->instance('Factions', $hash);
    }

    /**
     * @param string $hash
     *
     * @return Gender
     */
    public function gender(string $hash) : Gender
    {
        return $this->instance('Gender', $hash);
    }

    /**
     * @param string $hash
     *
     * @return HistoricalStat
     */
    public function historicalStat(string $hash) : HistoricalStat
    {
        return $this->instance('HistoricalStats', $hash);
    }

    /**
     * @param string $hash
     *
     * @return Location
     */
    public function location(string $hash) : Location
    {
        return $this->instance('Locations', $hash);
    }

    /**
     * @param string $hash
     *
     * @return Lore
     */
    public function lore(string $hash) : Lore
    {
        return $this->instance('Lore', $hash);
    }

    /**
     * @param string $hash
     *
     * @return Milestone
     */
    public function milestone(string $hash) : Milestone
    {
        return $this->instance('Milestone', $hash);
    }

    /**
     * @param string $hash
     *
     * @return Objective
     */
    public function objective(string $hash) : Objective
    {
        return $this->instance('Objectives', $hash);
    }

    /**
     * @param string $hash
     *
     * @return Place
     */
    public function place(string $hash) : Place
    {
        return $this->instance('Places', $hash);
    }

    /**
     * @param string $hash
     *
     * @return Progression
     */
    public function progression(string $hash) : Progression
    {
        return $this->instance('Progressions', $hash);
    }

    /**
     * @param string $hash
     *
     * @return InventoryBucket
     */
    public function inventoryBucket(string $hash) : InventoryBucket
    {
        return $this->instance('InventoryBuckets', $hash);
    }

    /**
     * @param string $hash
     *
     * @return InventoryItem
     */
    public function inventoryItem(string $hash) : InventoryItem
    {
        return $this->instance('InventoryItem', $hash);
    }

    /**
     * @param string $hash
     *
     * @return ItemCategory
     */
    public function itemCategory(string $hash) : ItemCategory
    {
        return $this->instance('ItemCategories', $hash);
    }

    /**
     * @param string $hash
     *
     * @return ItemTierType
     */
    public function itemTierType(string $hash) : ItemTierType
    {
        return $this->instance('ItemTierTypes', $hash);
    }

    /**
     * @param string $hash
     *
     * @return Race
     */
    public function race(string $hash) : Race
    {
        return $this->instance('Race', $hash);
    }

    /**
     * @param string $hash
     *
     * @return SandboxPerk
     */
    public function sandboxPerk(string $hash) : SandboxPerk
    {
        return $this->instance('SandboxPerks', $hash);
    }

    /**
     * @param string $hash
     *
     * @return SocketType
     */
    public function socketType(string $hash) : SocketType
    {
        return $this->instance('SocketTypes', $hash);
    }

    /**
     * @param string $hash
     *
     * @return Stat
     */
    public function stat(string $hash) : Stat
    {
        return $this->instance('Stat', $hash);
    }

    /**
     * @param string $hash
     *
     * @return StatGroup
     */
    public function statGroup(string $hash) : StatGroup
    {
        return $this->instance('StatGroups', $hash);
    }

    /**
     * @param string $hash
     *
     * @return TalentGrid
     */
    public function talentGrid(string $hash) : TalentGrid
    {
        return $this->instance('Talents', $hash);
    }

    /**
     * @param string $hash
     *
     * @return RewardSource
     */
    public function rewardSource(string $hash) : RewardSource
    {
        return $this->instance('RewardSources', $hash);
    }

    /**
     * @param string $hash
     *
     * @return Unlock
     */
    public function unlock(string $hash) : Unlock
    {
        return $this->instance('Unlocks', $hash);
    }

    /**
     * @param string $hash
     *
     * @return Vendor
     */
    public function vendor(string $hash) : Vendor
    {
        return $this->instance('Vendors', $hash);
    }

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

    /**
     * @param string $type
     * @param string $key
     *
     * @return mixed
     */
    protected function instance(string $type, string $key)
    {
        $key = (string) $key;
        $instance = array_get(static::$instances, "$type.$key");

        if (!$instance) {
            $namespace = '\\Destiny\\Definitions\\Manifest\\';
            $class = array_get(['Class' => 'DestinyClass'], $type, $type);

            $className = $namespace.$class;
            $instance = new $className($this->load($type, $key));

            static::$instances[$class][$key] = $instance;
        }

        return $instance;
    }
}
