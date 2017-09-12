<?php

namespace Destiny;

use Destiny\Definitions\AccountStats as StatDefinition;

/**
 * Class StatHandler.
 */
class StatHandler extends StatDefinition
{
    /**
     * Manifest constructor.
     *
     * @param array|null $definition
     */
    public function __construct(array $definition = null)
    {
        parent::__construct($definition);
    }

    /**
     * @param string $characterId
     * @param string $mode
     * @return StatisticsCollection
     */
    public function getCharacterStats(string $characterId, string $mode = 'allTime') : StatisticsCollection
    {
        if ($mode === 'allTime') {
            $mode = 'merged.allTime';
        } else {
            $mode = "results.$mode.allTime";
        }


        $stats = [];
        foreach ($this->characters as $character) {
            $stats[$character['characterId']] = array_get($character, $mode);
        }

        return new StatisticsCollection($stats[$characterId] ?? []);
    }
}
