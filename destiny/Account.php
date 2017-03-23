<?php

namespace Destiny;

/**
 * @property string $membershipType
 * @property string $membershipId
 * @property string $clanName
 * @property string $clanTag
 * @property array $inventory
 * @property int $grimoireScore
 * @property \Destiny\Player $player
 * @property \Destiny\CurrencyCollection $currencies
 * @property \Destiny\CharacterCollection $characters
 * @property \Destiny\AccountStatistics $statistics
 * @property StatisticsCollection $mergedStats
 */
class Account extends Model
{
    /**
     * @var \Destiny\Player
     */
    protected $player;

    /**
     * @var \Destiny\AccountStatistics
     */
    protected $statistics;

    /**
     * @var bool
     */
    protected $extended = false;

    public function __construct(Player $player, array $properties, array $stats = null)
    {
        parent::__construct($properties);
        $this->player = $player;
        $this->statistics = new AccountStatistics($this, $stats);

        $properties['characters'] = array_sort($properties['characters'], function ($value) {
            return $value['characterBase']['characterId'];
        });

        $this->characters = (new CharacterCollection($this, $properties['characters']));
    }

    public function load()
    {
        if (!$this->extended) {
            destiny()->accountDetails($this);
            $this->extended = true;
        }
    }

    protected function gCurrencies()
    {
        return new CurrencyCollection($this->properties['inventory']['currencies']);
    }

    protected function gPlayer()
    {
        return $this->player;
    }

    protected function gMergedStats()
    {
        if (!isset($this->statistics->mergedAllCharacters['merged']['allTime'])) {
            throw new \Exception('No stats found');
        }

        return new StatisticsCollection($this->statistics->mergedAllCharacters['merged']['allTime']);
    }

    protected function sStatistics(AccountStatistics $stats)
    {
        $this->statistics = $stats;
    }

    protected function gStatistics()
    {
        return $this->statistics;
    }
}
