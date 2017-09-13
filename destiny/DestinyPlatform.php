<?php

namespace Destiny;

use App\Account;
use App\Enums\ActivityModeType;
use App\Enums\StatGroupType;

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
    protected function destinyRequest($uri, $params = [], $cacheMinutes = null, $salvageable = true) : DestinyRequest
    {
        return new DestinyRequest($uri, $params, $cacheMinutes, $salvageable);
    }

    /**
     * @return DestinyRequest
     */
    public function manifest() : DestinyRequest
    {
        return $this->destinyRequest('destiny2/manifest/', false);
    }

    /**
     * @param $gamertag
     *
     * @return DestinyRequest
     */
    public function searchDestinyPlayer(string $gamertag) : DestinyRequest
    {
        $gamertag = rawurlencode(trim($gamertag));

        return $this->destinyRequest("Destiny2/SearchDestinyPlayer/all/$gamertag/", CACHE_PLAYER, false);
    }

    /**
     * @param Account $account
     *
     * @return DestinyRequest
     */
    public function getDestinyProfile(Account $account) : DestinyRequest
    {
        $profileBuilder = (new DestinyComponentUrlBuilder("Destiny2/$account->membership_type/Profile/$account->membership_id/"))
            ->addProfiles()
            ->addProfileCurrencies()
            ->addCharacters()
            ->addCharacterProgressions()
            ->addCharacterEquipment()
            ->addItemInstances();

        return $this->destinyRequest($profileBuilder->buildUrl(), $profileBuilder->getComponentArray(), CACHE_DEFAULT, false);
    }

    /**
     * @param Account $account
     * @param array   $modes
     *
     * @return DestinyRequest
     */
    public function getDestinyStats(Account $account, $modes = [StatGroupType::General, StatGroupType::Activity, StatGroupType::Weapons]) : DestinyRequest
    {
        return $this->destinyRequest("Destiny2/$account->membership_type/Account/$account->membership_id/Stats/", ['groups' => $modes], CACHE_DEFAULT, true);
    }

    /**
     * @param Player $player
     *
     * @return DestinyRequest
     */
    public function getGroups(Player $player) : DestinyRequest
    {
        // 0/1 = no filters & groupType = clan. Thanks vpzed
        return $this->destinyRequest('GroupV2/User/'.$player->membershipType.'/'.$player->membershipId.'/0/1/', null, CACHE_DEFAULT, false);
    }

    /**
     * @param Group $group
     * @return DestinyRequest
     */
    public function getClan(Group $group) : DestinyRequest
    {
        return $this->destinyRequest("GroupV2/$group->groupId/", null, CACHE_DEFAULT, true);
    }

    /**
     * @param Group $group
     *
     * @return DestinyRequest
     */
    public function getClanMembers(Group $group) : DestinyRequest
    {
        return $this->destinyRequest('GroupV2/'.$group->groupId.'/Members/', ['currentPage' => 1], CACHE_DEFAULT, false);
    }

    /**
     * @param Group $group
     * @param array $modes
     *
     * @return DestinyRequest
     */
    public function getClanStats(Group $group, array $modes = [ActivityModeType::AllPvE, ActivityModeType::AllPvP, ActivityModeType::Nightfall]) : DestinyRequest
    {
        return $this->destinyRequest('Destiny2/Stats/AggregateClanStats/'.$group->groupId.'/', ['modes' => $modes], CACHE_DEFAULT, false);
    }

    /**
     * @param Group  $group
     * @param array  $modes
     * @param string $statId
     *
     * @return DestinyRequest
     */
    public function getClanLeaderboard(Group $group, array $modes = [ActivityModeType::AllPvP, ActivityModeType::AllPvE], string $statId = '') : DestinyRequest
    {
        $params = ['modes' => implode(',', $modes), 'maxtop' => 10];

        if (!empty($statId)) {
            $params = array_add($params, 'statId', $statId);
        }

        return $this->destinyRequest("Destiny2/Stats/Leaderboards/Clans/$group->groupId/", $params, 60 * 24, true);
    }

    /**
     * @return DestinyRequest
     */
    public function getMilestones() : DestinyRequest
    {
        return $this->destinyRequest('Destiny2/Milestones/', null, CACHE_INDEX, false);
    }

    /**
     * @param string $milestoneHash
     * @return DestinyRequest
     */
    public function getMilestoneContent(string $milestoneHash) : DestinyRequest
    {
        return $this->destinyRequest("Destiny2/Milestones/$milestoneHash/Content/", null, CACHE_INDEX, false);
    }
}
