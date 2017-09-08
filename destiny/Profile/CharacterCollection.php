<?php

declare(strict_types=1);

namespace Destiny\Profile;

use Destiny\Collection;
use Destiny\Definitions\Components\Character as CharacterDefinition;

/**
 * Class CharacterCollection.
 *
 * @method CharacterDefinition offsetGet($key)
 */
class CharacterCollection extends Collection
{
    public function __construct(array $properties)
    {
        $characters = [];

        if (isset($properties['data'])) {
            foreach ($properties['data'] as $char) {
                $characters[$char['characterId']] = new CharacterDefinition($char);
            }
        }

        $characters = array_sort($characters, function ($value) {
            return $value['characterId'];
        });

        parent::__construct($characters);
    }
}
