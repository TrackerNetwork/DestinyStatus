<?php

declare(strict_types=1);

namespace Destiny;

use App\Account;

/**
 * Class Destiny.
 */
class Destiny
{
    /**
     * @var DestinyClient
     */
    protected $client;

    /**
     * @var DestinyPlatform
     */
    protected $platform;

    public function __construct(DestinyClient $client, DestinyPlatform $platform)
    {
        $this->client = $client;
        $this->platform = $platform;
    }

    /**
     * @return Manifest
     */
    public function manifest() : Manifest
    {
        $result = $this->client->r($this->platform->manifest());

        return new Manifest($result);
    }

    /**
     * @param string $gamertag
     *
     * @return \Destiny\PlayerCollection
     */
    public function player($gamertag) : PlayerCollection
    {
        $result = $this->client->r($this->platform->searchDestinyPlayer($gamertag));

        return new PlayerCollection($gamertag, $result);
    }

    /**
     * @param Player $player
     *
     * @return Profile
     */
    public function profile(Player $player) : Profile
    {
        return \DB::transaction(function () use ($player) {

            /** @var Account $account */
            $account = Account::updateOrCreate([
                'membership_id'   => $player->membershipId,
                'membership_type' => $player->membershipType,
            ], [
                'name' => $player->displayName,
            ]);

            $result = $this->client->r($this->platform->getDestinyProfile($account));

            return new Profile($account, $result);
        });
    }
}
