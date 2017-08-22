<?php

namespace App\Console\Commands;

use App\Models\AssignedBadge;
use App\Models\Badge;
use App\Models\Destiny1\Stats;
use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\Builder;

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

        $obtainedAccountIds = AssignedBadge::where('badge_id', $veteran->id)
            ->pluck('account_id')
            ->toArray();

        $pending = Stats::whereNotIn('account_id', $obtainedAccountIds)
            ->where(function (Builder $query) {
                $query->where('raid_completions', '>=', 100);
                $query->orWhere('kd', '>=', 0.5);
                $query->orWhere('grimoire', '>=', 3000);
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
