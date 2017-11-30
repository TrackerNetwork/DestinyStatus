<?php

namespace App\Console\Commands;

use App\Models\AssignedBadge;
use App\Models\Badge;
use App\Models\Destiny1\Stats;
use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Query\JoinClause;

/**
 * Class DestinyGrantVeteranMedalCommand.
 */
class DestinyGrantVeteranMedalCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'destiny:grant-veteran';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Gives Veteran Medal to those who earned it';

    /**
     * DestinyGrantVeteranMedalCommand constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        /** @var Badge $veteran */
        $veteran = Badge::where('slug', 'veteran')->first();

        $neededAccountIds = \DB::query()
            ->from('accounts')
            ->join('badge_assignment', function (JoinClause $join) use ($veteran) {
                $join->on('accounts.id', '=', 'badge_assignment.account_id');
                $join->where('badge_assignment.badge_id', '=', $veteran->id);
            }, null, null, 'LEFT OUTER')
            ->join('d1_stats', function (JoinClause $join) {
                $join->on('accounts.id', '=', 'd1_stats.account_id');
            }, null, null, 'LEFT OUTER')
            ->whereNull('badge_assignment.account_id')
            ->whereNotNull('d1_stats.account_id')
            ->orderBy('accounts.id', 'DESC')
            ->pluck('accounts.id')
            ->toArray();

        $pending = Stats::whereIn('account_id', $neededAccountIds)
            ->where(function (Builder $query) {
                $query->where('raid_completions', '>=', 100);
                $query->orWhere('kd', '>=', 0.8);
                $query->orWhere('grimoire', '>=', 3500);
            })
            ->select('account_id')
            ->get()
            ->toArray();

        foreach ($pending as $item) {
            $this->info('Assigning to ID: '.$item['account_id']);
            AssignedBadge::create([
                'account_id' => $item['account_id'],
                'badge_id'   => $veteran->id,
            ]);
        }
    }
}
