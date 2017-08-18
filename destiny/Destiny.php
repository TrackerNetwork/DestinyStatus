<?php

namespace Destiny;

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
     * @return array
     */
    public function manifest()
    {
        return $this->client->r($this->platform->manifest());
    }

    /**
     * @param string $gamertag
     *
     * @return \Destiny\PlayerCollection
     */
    public function player($gamertag)
    {
        $result = $this->client->r($this->platform->searchDestinyPlayer($gamertag));

        return new PlayerCollection($gamertag, $result);
    }
}
