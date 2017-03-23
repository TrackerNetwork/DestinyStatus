<?php

namespace Destiny\AdvisorsTwo;

use Destiny\Definitions\Destination;
use Destiny\Definitions\Faction;
use Destiny\Model;

/**
 * @property string $categoryHash
 * @property string $icon
 * @property string $image
 * @property string $advisorTypeCategory
 * @property string $activityHash
 * @property string $destinationHash
 * @property string $factionHash
 * @property string $placeHash
 * @property string $about
 * @property string $status
 * @property Tip[] $tips
 * @property array $recruitmentIds
 * @property Destination $destination
 * @property Faction $faction
 */
class Display extends Model
{
    public function __construct(array $properties)
    {
        parent::__construct($properties);
    }

    public function gDestination()
    {
        return manifest()->destination($this->destinationHash);
    }

    public function gFaction()
    {
        return manifest()->faction($this->factionHash);
    }

    protected function gTips()
    {
        $tips = $this->newCollection();

        foreach (array_get($this->properties, 'tips') ?: [] as $properties) {
            $tip = new Tip(['message' => $properties]);
            $tips->push($tip);
        }

        return $tips;
    }
}
