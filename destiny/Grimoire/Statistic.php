<?php

namespace Destiny\Grimoire;

use Destiny\Grimoire;

/**
 * @property int $statNumber
 * @property int $cardId
 * @property string $statName
 * @property string $accumulatorHash
 * @property \Destiny\Grimoire\RankCollection $rankCollection
 * @property \Destiny\Grimoire\Card $card
 * @property array $status
 * @property int $points
 * @property int $score
 * @property int $value
 * @property string $displayValue
 * @property float $percent
 */
class Statistic extends Model
{
    protected $card;

    public function __construct(Card $card, array $properties)
    {
        parent::__construct($card->grimoire, $properties);
        $this->card = $card;
        $this->score = 0;
        $this->value = array_get($this->status, 'value');
        $this->displayValue = array_get($this->status, 'displayValue');
        $this->rankCollection = new RankCollection($this, array_get($properties, 'rankCollection'));

        foreach ($this->rankCollection as $rank) {
            if ($rank->completed) {
                $this->score += $rank->points;
            }
        }
    }

    public function hasRanks()
    {
        return !$this->rankCollection->isEmpty();
    }

    protected function gCard()
    {
        return $this->card;
    }

    protected function gStatus()
    {
        if (!$this->card->status) {
            return [];
        }

        return $this->card->status->statisticCollection->get($this->statNumber);
    }

    protected function gPoints()
    {
        $points = 0;

        foreach ($this->rankCollection as $rank) {
            $points += $rank->points;
        }

        return $points;
    }

    protected function gPercent()
    {
        $percent = 0;

        if ($this->hasRanks()) {
            $percent = $this->value / $this->rankCollection->last()->threshold * 100;
        }

        return $percent > 100 ? 100 : $percent;
    }
}
