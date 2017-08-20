<?php

namespace App\Console\Commands;

use App\Account;
use App\Helpers\ConsoleHelper;
use App\Models\AssignedBadge;
use App\Models\Badge;
use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class DestinyMedalCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'destiny:medal {action} {name} {type} {medal}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'destiny:medal [give|take] iBot xbl donator';

    /**
     * DestinyMedalCommand constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @throws \Exception
     */
    public function handle()
    {
        $action = $this->argument('action');
        $name = $this->argument('name');
        $type = $this->argument('type');
        $badge = $this->argument('medal');

        if (!in_array($action, ['give', 'take'])) {
            throw new \Exception('action must be give|take. "'.$action.'" given.');
        }

        $membershipType = ConsoleHelper::getIdFromConsoleString($type);

        try {
            $badge = Badge::where('slug', slug($badge))
                ->firstOrFail();
        } catch (ModelNotFoundException $ex) {
            throw new \Exception($badge.' was not a medal in our system.');
        }

        try {
            $account = Account::where('slug', slug($name))
                ->where('membership_type', $membershipType)
                ->firstOrFail();
        } catch (ModelNotFoundException $ex) {
            throw new \Exception($name.' was not found in system on console: '.$type.'. Try loading on DS first.');
        }

        if (!AssignedBadge::where('account_id', $account->id)->where('badge_id', $badge->id)->exists()) {
            if ($action === 'give') {
                $assignedBadge = new AssignedBadge([
                    'account_id' => $account->id,
                    'badge_id'   => $badge->id,
                ]);

                if ($assignedBadge->save()) {
                    $this->info('Badge added!');
                }
            }
        } else {
            if ($action === 'give') {
                $this->info('Badge has already been given!');
            } else {
                AssignedBadge::where('account_id', $account->id)->where('badge_id', $badge->id)->delete();
                $this->info('Badge revoked!');
            }
        }
    }
}
