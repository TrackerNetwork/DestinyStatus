<?php

namespace Destiny;

/**
 * Class DestinyPlatform.
 */
class DestinyPlatform
{
    /**
     * @param $uri
     * @param array $params
     * @param null  $cacheMinutes
     * @param bool  $salvageable
     *
     * @return DestinyRequest
     */
    protected function destinyRequest($uri, $params = [], $cacheMinutes = null, $salvageable = true)
    {
        return new DestinyRequest($uri, $params, $cacheMinutes, $salvageable);
    }

    /**
     * @return DestinyRequest
     */
    public function manifest()
    {
        return $this->destinyRequest('destiny2/manifest/', false);
    }

    /**
     * @param $gamertag
     *
     * @return DestinyRequest
     */
    public function searchDestinyPlayer($gamertag)
    {
        $gamertag = rawurlencode(trim($gamertag));

        return $this->destinyRequest("destiny/searchdestinyplayer/all/$gamertag/", CACHE_PLAYER, false);
    }
}
