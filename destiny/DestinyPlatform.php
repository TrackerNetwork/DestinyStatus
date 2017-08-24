<?php

namespace Destiny;

use App\Account;

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

    /**
     * @param Account $account
     * @return DestinyRequest
     */
    public function getDestinyProfile(Account $account)
    {
        return $this->destinyRequest("Destiny2/$account->membership_type/Profile/$account->membership_id/", CACHE_DEFAULT, 5);
    }
}
