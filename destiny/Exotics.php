<?php

namespace Destiny;

/**
 * Class Exotics.
 */
class Exotics extends Model
{
    /**
     * @var array
     */
    public $exotics = [
        [
            'name'    => 'Tlaloc',
            'cardIds' => [700302],
            'weapon'  => 700302,
            'hint'    => 'Hit Rank 3 with Gunsmith under Warlock character.',
        ],
        [
            'name'    => 'Fabian Strategy',
            'cardIds' => [700301],
            'weapon'  => 700301,
            'hint'    => 'Hit Rank 3 with Gunsmith under Titan character.',
        ],
        [
            'name'    => 'Ace of Spades',
            'cardIds' => [700300],
            'weapon'  => 700300,
            'hint'    => 'Hit Rank 3 with Gunsmith under Hunter character.',
        ],
        [
            'name'    => 'Iron Gjallarhorn',
            'cardIds' => [304020, 800439],
            'weapon'  => 304020,
            'hint'    => 'Complete ROI Campaign and start Echos of the Past quest.',
        ],
        [
            'name'    => 'First Curse',
            'cardIds' => [700170],
            'weapon'  => 700170,
            'hint'    => 'Hit Rank 5 with Gunsmith under any character and start Imprecation Quest.',
        ],
        [
            'name'    => 'Khvostov 7G-0X',
            'cardIds' => [800402],
            'weapon'  => 800402,
            'hint'    => 'Dismantle an original Khvostov or find a schematic in the Fallen Ketch in the Breach.',
        ],
        [
            'name'    => 'Black Spindle',
            'cardIds' => [700240],
            'weapon'  => 700240,
            'hint'    => 'Do the alternative ending to the Lost to Light mission killing all Taken in 10 minutes.',
        ],
        [
            'name'    => 'No Time To Explain',
            'cardIds' => [700180],
            'weapon'  => 700180,
            'hint'    => 'Do the alternative ending to the Paradox mission finding all dead ghosts in the vault.',
        ],
        [
            'name'    => 'Vex Mythoclast',
            'cardIds' => [303065],
            'weapon'  => 303065,
            'hint'    => 'Random drop from Atheon during Vault of Glass raid.',
        ],
        [
            'name'    => 'Necrochasm',
            'cardIds' => [302037],
            'weapon'  => 302037,
            'hint'    => 'Obtain Husk of the Pit and upgrade to Eidolon Ally then use Crux of Crota (Hard mode drop at Crota).',
        ],
        [
            'name'    => 'Touch of Malice',
            'cardIds' => [700130],
            'weapon'  => 700130,
            'hint'    => 'Multiple quests related to collecting 45 Calcified Fragments.',
        ],
        [
            'name'    => 'Boolean Gemini',
            'cardIds' => [700160],
            'weapon'  => 700160,
            'hint'    => 'Complete Taken War and Petra Quests, then hit Rank 3 with Queen\'s Wrath.',
        ],
        [
            'name'    => 'Thorn',
            'cardIds' => [302150],
            'weapon'  => 302150,
            'hint'    => 'Quest earned after turning in Iron Lord bounties (random).',
        ],
        [
            'name'    => 'Outbreak Prime',
            'cardIds' => [800401],
            'weapon'  => 800401,
            'hint'    => 'Unlock all 5 monitors in the Wrath of the Machine raid.',
        ],
        [
            'name'    => 'Young Wolf\'s Howl',
            'cardIds' => [800452],
            'weapon'  => 800452,
            'hint'    => 'Complete Rise of Iron Campaign.',
        ],
        [
            'name'    => 'Dark-Drinker',
            'cardIds' => [700292],
            'weapon'  => 700292,
            'hint'    => 'Infuse Void Edge to at least 280 light and start A Sword Reforged Quest.',
        ],
        [
            'name'    => 'Raze-Lighter',
            'cardIds' => [700291],
            'weapon'  => 700291,
            'hint'    => 'Infuse Sol Edge to at least 280 light and start A Sword Reforged Quest.',
        ],
        [
            'name'    => 'Bolt-Caster',
            'cardIds' => [700290],
            'weapon'  => 700290,
            'hint'    => 'Infuse Arc Edge to at least 280 light and start A Sword Reforged Quest.',
        ],
        [
            'name'    => 'Sleeper Simulant',
            'cardIds' => [700250],
            'weapon'  => 700250,
            'hint'    => 'Find all four DVALIN Relics to unlock The First Firewall Quest.',
        ],
        [
            'name'    => 'Chaperone',
            'cardIds' => [700220],
            'weapon'  => 700220,
            'hint'    => 'Obtain Level 40 and hit Rank 3 in Crucible.',
        ],
        [
            'name'    => 'Nova Mortis',
            'cardIds' => [801031],
            'weapon'  => 801031,
            'hint'    => 'Get Xur\'s Tag via the 7th reward in Competitive Spirit book to start the Quest.',
        ],
        [
            'name'    => 'Abbadon',
            'cardIds' => [801030],
            'weapon'  => 801030,
            'hint'    => 'Obtain quest after unlocking the Nova Mortis.',
        ],
        [
            'name'    => 'Ice Breaker',
            'cardIds' => [303090],
            'weapon'  => 303090,
            'hint'    => 'Random chance for completing Zavala\'s Sunrise Bounty',
        ],
    ];

    /**
     * Exotics constructor.
     *
     * @param Grimoire $grimoire
     */
    public function __construct(Grimoire $grimoire)
    {
        $properties = [];

        foreach ($this->exotics as $exotic) {
            $complete = true;
            foreach ($exotic['cardIds'] as $cardId) {
                $card = $grimoire->getCard($cardId);

                if ($card === null) {
                    $complete = false;
                } elseif ($card->isIncomplete()) {
                    $complete = false;
                }

                if ($cardId === $exotic['weapon']) {
                    $exotic['weapon'] = $card;
                }
            }

            $exotic['complete'] = $complete;

            $properties['weapons'][] = $exotic;
        }

        $properties['weapons'] = array_sort($properties['weapons'], function ($item) {
            return !($item['complete']).$item['name'];
        });

        parent::__construct($properties);
    }
}
