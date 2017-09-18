<?php

declare(strict_types=1);

namespace Destiny;

use App\Account;
use App\Enums\ActivityModeType;
use Destiny\Definitions\Components\Character;
use Destiny\Definitions\PublicMilestone;
use Destiny\Milestones\MilestoneHandler;

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
     * @throws \DestinyNoClanException
     *
     * @return Group
     */
    public function groups(Player $player) : Group
    {
        $result = $this->client->r($this->platform->getGroups($player));

        if (isset($result['totalResults']) && $result['totalResults'] > 0) {
            return new Group($result['results'][0]['group']);
        }

        throw new \DestinyNoClanException('Could not locate clan for user');
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

    /**
     * @param Account $account
     *
     * @return StatHandler
     */
    public function stats(Account $account) : StatHandler
    {
        $results = $this->client->r($this->platform->getDestinyStats($account));

        return new StatHandler($results);
    }

    /**
     * @param Profile $profile
     *
     * @internal param Player $player
     */
    public function characterStats(Profile $profile)
    {
        $requests = [];

        /** @var Character $character */
        foreach ($profile->characters as $character) {
            $requests[$character->characterId.'.stats'] = $this->platform->getCharacterStats($profile, $character);
        }

        $results = $this->client->r($requests);

        dd($results);
    }

    /**
     * @return MilestoneHandler
     */
    public function publicMilestones() : MilestoneHandler
    {
        $milestones = $this->client->r($this->platform->getMilestones());

        return new MilestoneHandler(['milestones' => $milestones]);
    }

    /**
     * @param string $milestoneHash
     */
    public function milestoneContent(string $milestoneHash)
    {
        $milestone = $this->client->r($this->platform->getMilestoneContent($milestoneHash));

        dd($milestone);
    }

    /**
     * @param Group $group
     */
    public function clanMembers(Group $group)
    {
        $result = $this->client->r($this->platform->getClanMembers($group));

        // paginated, unsure if active clan or group members
        dd($result);
    }

    /**
     * @param Group $group
     *
     * @return Definitions\Group
     */
    public function clanOverview(Group $group) : \Destiny\Definitions\Group
    {
        $result = $this->client->r($this->platform->getClan($group));

        return new \Destiny\Definitions\Group($result);
    }

    /**
     * @param Group $group
     *
     * @return StatisticsCollection
     */
    public function clanStats(Group $group) : StatisticsCollection
    {
        $result = $this->client->r($this->platform->getClanStats($group));

        return new StatisticsCollection($result ?? []);
    }

    /**
     * @param Group $group
     *
     * @return LeaderboardHandler
     */
    public function clanLeaderboards(Group $group) : LeaderboardHandler
    {
        $result = $this->client->r($this->platform->getClanLeaderboard($group, [ActivityModeType::AllPvP, ActivityModeType::AllPvE]));

        return new LeaderboardHandler($result ?? []);
    }

    /**
     * @param Group $group
     *
     * @return PublicMilestone
     */
    public function clanRewards(Group $group) : PublicMilestone
    {
        $result = $this->client->r($this->platform->getClanWeeklyRewards($group));

        return new PublicMilestone($result);
    }
}
