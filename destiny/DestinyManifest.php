<?php

namespace Destiny;

use Cache;
use Destiny\Definitions\Manifest\InventoryBucket;
use Destiny\Definitions\Manifest\InventoryItem;
use Destiny\Definitions\Manifest\ItemTierType;
use Destiny\Definitions\Manifest\Progression;
use Destiny\Definitions\Manifest\Stat;
use Destiny\Definitions\Manifest\StatGroup;

class DestinyManifest
{
    /**
     * @var array
     */
    protected static $instances = [];

    /**
     * @param string $hash
     * @return Progression
     */
    public function progression(string $hash) : Progression
    {
        return $this->instance('Progressions', $hash);
    }

    /**
     * @param string $hash
     * @return InventoryBucket
     */
    public function inventoryBucket(string $hash) : InventoryBucket
    {
        return $this->instance('InventoryBuckets', $hash);
    }

    /**
     * @param string $hash
     * @return InventoryItem
     */
    public function inventoryItem(string $hash) : InventoryItem
    {
        return $this->instance('Items', $hash);
    }

    /**
     * @param string $hash
     * @return ItemTierType
     */
    public function itemTierType(string $hash) : ItemTierType
    {
        return $this->instance('ItemTierTypes', $hash);
    }

    /**
     * @param string $hash
     * @return Stat
     */
    public function stat(string $hash) : Stat
    {
        return $this->instance('Stats', $hash);
    }

    /**
     * @param string $hash
     * @return StatGroup
     */
    public function statGroup(string $hash) : StatGroup
    {
        return $this->instance('StatGroups', $hash);
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
     * @return mixed
     */
    protected function instance(string $type, string $key)
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
}
