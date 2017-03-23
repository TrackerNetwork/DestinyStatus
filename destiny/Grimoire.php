<?php

namespace Destiny;

use Destiny\Grimoire\Card;
use Destiny\Grimoire\CardStatusCollection;
use Destiny\Grimoire\ThemeCollection;

/**
 * @property int $score
 * @property int $points
 * @property string $icon
 * @property \Destiny\Grimoire\CardStatusCollection $cardCollection
 * @property array $cardsToHide
 * @property array $bonuses
 * @property \Destiny\Definitions\Grimoire $definitions
 * @property \Destiny\Grimoire\ThemeCollection $themeCollection
 * @property \Destiny\Grimoire\Theme[] $themes
 * @property \Destiny\Grimoire\Card[] $cards
 * @property \Destiny\Grimoire\Card[] $cardsIncomplete
 */
class Grimoire extends Model
{
    /**
     * @var \Destiny\Player
     */
    protected $player;

    public function __construct(Player $player, array $properties)
    {
        parent::__construct($properties);

        $this->player = $player;
        $this->cardCollection = new CardStatusCollection($this, $properties['cardCollection']);
        $this->themeCollection = new ThemeCollection($this, $this->definitions->themeCollection);
    }

    public function getCard($cardId)
    {
        $cards = $this->cards;

        if (isset($cards[$cardId])) {
            return $cards[$cardId];
        }
    }

    protected function gDefinitions()
    {
        return manifest()->grimoire();
    }

    protected function gIcon()
    {
        return '/img/theme/destiny/icons/icon_grimoire_lightgray.png';
    }

    protected function gPoints()
    {
        $points = 0;

        $this->cards->filter(function (Card $card) use (&$points) {
            $points += $card->totalPoints;
        });

        return $points;
    }

    protected function gCards()
    {
        $collection = $this->newCollection();

        foreach ($this->themeCollection as $theme) {
            foreach ($theme->pageCollection as $page) {
                foreach ($page->cardBriefs as $card) {
                    $collection->put($card->cardId, $card);
                }
            }
        }

        return $collection->sort(function (Card $a, Card $b) {
            if ($a->hasRanks()) {
                if ($b->hasRanks()) {
                    if ($a->percent != $b->percent) {
                        return $a->percent > $b->percent ? -1 : +1;
                    }

                    goto name;
                }

                return -1;
            }

            if ($b->hasRanks()) {
                if ($a->hasRanks()) {
                    if ($a->percent != $b->percent) {
                        return $a->percent > $b->percent ? +1 : -1;
                    }

                    goto name;
                }

                return +1;
            }

            name:

            if ($a->active && !$b->active) {
                return -1;
            } elseif ($b->active && !$a->active) {
                return +1;
            }

            return strcmp($a->cardName, $b->cardName);
        });
    }

    protected function gCardsIncomplete()
    {
        return $this->cards->filter(function (Card $card) {
            return $card->isIncomplete();
        });
    }
}
