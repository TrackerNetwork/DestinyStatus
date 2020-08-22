<?php

declare(strict_types=1);

namespace Destiny;

use App\Account;
use App\Enums\ActivityModeType;
use App\Exceptions\Destiny\NoClanException;
use Destiny\Definitions\Components\Character;
use Destiny\Definitions\PublicMilestone;
use Destiny\Milestones\MilestoneHandler;

/**
 * Class Destiny.
 */
class Destiny
{
    protected DestinyClient $client;
    protected DestinyPlatform $platform;

    public function __construct(DestinyClient $client, DestinyPlatform $platform)
    {
        $this->client = $client;
        $this->platform = $platform;
    }

    public function manifest(): Manifest
    {
        $result = $this->client->r($this->platform->manifest());

        return new Manifest($result);
    }

    public function match(string $activityId)
    {
        $result = $this->client->r($this->platform->getPostGameCarnageReport($activityId));

        dd($result);
    }

    public function player(string $gamertag): PlayerCollection
    {
        $result = $this->client->r($this->platform->searchDestinyPlayer($gamertag));

        return new PlayerCollection($gamertag, $result);
    }

    public function groups(Player $player): Group
    {
        $result = $this->client->r($this->platform->getGroups($player));

        if (isset($result['totalResults']) && $result['totalResults'] > 0) {
            return new Group($result['results'][0]['group']);
        }

        throw new NoClanException('Could not locate clan for user');
    }

    public function profile(Player $player): Profile
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

    public function stats(Account $account): StatHandler
    {
        $results = $this->client->r($this->platform->getDestinyStats($account));

        return new StatHandler($results);
    }

    public function characterStats(Profile $profile): StatHandler
    {
        $requests = [];

        /** @var Character $character */
        foreach ($profile->characters as $character) {
            $requests[$character->characterId.'.stats'] = $this->platform->getCharacterStats($profile, $character);
        }

        $results = $this->client->r($requests);

        return new StatHandler($results);
    }

    public function publicMilestones(): MilestoneHandler
    {
        $milestones = $this->client->r($this->platform->getMilestones());

        return new MilestoneHandler(['milestones' => $milestones]);
    }

    public function milestoneContent(string $milestoneHash)
    {
        $milestone = $this->client->r($this->platform->getMilestoneContent($milestoneHash));

        dd($milestone);
    }

    public function clanMembers(Group $group)
    {
        $result = $this->client->r($this->platform->getClanMembers($group));

        // paginated, unsure if active clan or group members
        dd($result);
    }

    public function clanOverview(Group $group): \Destiny\Definitions\Group
    {
        $result = $this->client->r($this->platform->getClan($group));

        return new \Destiny\Definitions\Group($result);
    }

    public function clanStats(Group $group): StatisticsCollection
    {
        $result = $this->client->r($this->platform->getClanStats($group));

        return new StatisticsCollection($result ?? []);
    }

    public function clanLeaderboards(Group $group): LeaderboardHandler
    {
        $result = $this->client->r($this->platform->getClanLeaderboard($group, [ActivityModeType::AllPvP, ActivityModeType::AllPvE]));

        return new LeaderboardHandler($result ?? []);
    }

    public function clanRewards(Group $group): PublicMilestone
    {
        $result = $this->client->r($this->platform->getClanWeeklyRewards($group));

        return new PublicMilestone($result);
    }

    public function clanAll(Group $group): array
    {
        $leaderboard = $this->platform->getClanLeaderboard($group, [ActivityModeType::AllPvP, ActivityModeType::AllPvE]);
        $rewards = $this->platform->getClanWeeklyRewards($group);

        return $this->client->r([
            'leaderboards' => $leaderboard,
            'reward'       => $rewards,
        ]);
    }
}
