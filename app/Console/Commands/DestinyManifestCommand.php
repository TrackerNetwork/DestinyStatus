<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

/**
 * Class DestinyManifestCommand.
 */
class DestinyManifestCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $signature = 'destiny:manifest {--extract} {--download}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update definitions from Bungie.';

    protected $url;
    protected $version;
    protected $versionFile;
    protected $versionDb;

    public function handle()
    {
        $this->info('Updating manifest');

        $manifest = destiny()->manifest();

        $this->version = $manifest->version;
        $this->url = bungie(array_get($manifest, 'mobileWorldContentPaths.en'));
        $this->versionFile = base_path('database/manifest/.version');
        $this->versionDb = base_path("database/manifest/$this->version.sqlite");

        if (!is_file($this->versionFile)) {
            \File::put($this->versionFile, '');
        }

        $currentVersion = \File::get($this->versionFile);
        $versionChanged = ($this->version !== $currentVersion) || !is_file($this->versionDb);

        if ($this->option('extract') || $this->option('download') || $versionChanged) {
            if ($this->option('download') || $versionChanged) {
                $this->download();
            }

            $this->extract();
            $this->call('cache:clear');
        } else {
            $this->comment('No updates available.');
        }

        $this->line("<info>Current version:</info> <comment>$this->version</comment>");
    }

    protected function download()
    {
        $this->output->write('<comment>Downloading manifest version ('.$this->version.') ... </comment>');

        $tmp = storage_path("$this->version.zip");
        \File::put($tmp, file_get_contents($this->url));

        $zip = new \ZipArchive();
        if (!$zip->open($tmp)) {
            throw new \Exception('Unable to open Destiny Manifest from Bungie');
        }

        \File::put($this->versionDb, $zip->getFromIndex(0));
        \File::put($this->versionFile, $this->version);

        $zip->close();
        \File::delete($tmp);

        $this->comment('Done!');
    }

    protected function extract()
    {
        $this->comment('Extracting definitions ...');

        $db = new \SQLite3($this->versionDb);

        // extract all the definitions
        $map = [
            'Activity'                    => 'hash',
            'ActivityGraph'               => 'hash',
            'ActivityMode'                => 'hash',
            'ActivityModifier'            => 'hash',
            'ActivityType'                => 'hash',
            'Bond'                        => 'hash',
            'Class'                       => 'hash',
            'DamageType'                  => 'hash',
            'Destination'                 => 'hash',
            'EnemyRace'                   => 'hash',
            'Faction'                     => 'hash',
            'Gender'                      => 'hash',
            'HistoricalStats'             => 'statId',
            'InventoryBucket'             => 'hash',
            'InventoryItem'               => 'hash',
            'ItemCategory'                => 'hash',
            'ItemTierType'                => 'hash',
            'Location'                    => 'hash',
            'Lore'                        => 'hash',
            'MedalTier'                   => 'hash',
            'Milestone'                   => 'hash',
            'Objective'                   => 'hash',
            'Place'                       => 'hash',
            'Progression'                 => 'hash',
            'ProgressionLevelRequirement' => 'hash',
            'Race'                        => 'hash',
            'RewardSource'                => 'hash',
            'SackRewardItemList'          => 'hash',
            'SandboxPerk'                 => 'hash',
            'SocketCategory'              => 'hash',
            'SocketType'                  => 'hash',
            'Stat'                        => 'hash',
            'StatGroup'                   => 'hash',
            'TalentGrid'                  => 'hash',
            'Unlock'                      => 'hash',
            'Vendor'                      => 'hash',
        ];

        foreach ($map as $folder => $key) {
            $table = "Destiny{$folder}Definition";
            $result = $db->prepare("SELECT json FROM $table")->execute();
            while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
                $json = json_decode($row['json'], true);
                $hash = (string) array_get($json, $key);

                $this->export($folder, $hash, $json);
            }

            $this->line($folder);
        }

        $db->close();
    }

    protected function export($folder, $hash, array $json)
    {
        $path = $this->path($folder);

        \File::put("$path/$hash.php", '<?php return '.var_export($json, true).";\n");

        if (function_exists('opcache_invalidate')) {
            opcache_invalidate($path, true);
        }
    }

    protected function path($folder)
    {
        $path = base_path("database/manifest/$folder");

        if (!\File::isDirectory($path)) {
            \File::makeDirectory($path, 0755, true);
        }

        return $path;
    }
}
