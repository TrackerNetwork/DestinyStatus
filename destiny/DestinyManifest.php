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
}
