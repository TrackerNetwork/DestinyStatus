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

        $this->url = bungie(array_get($manifest, 'mobileWorldContentPaths.en'));
        $this->version = array_get($manifest, 'version');
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

        // extract Grimoire definition
        $grimoire = $db->prepare('SELECT json FROM DestinyGrimoireDefinition WHERE id = 0')->execute()->fetchArray(SQLITE3_ASSOC);
        $this->export('Grimoire', 0, json_decode($grimoire['json'], true));

        // extract all the other definitions
        $map = [
            'ActivityBundle'     => 'bundleHash',
            'Activity'           => 'activityHash',
            'ActivityType'       => 'activityTypeHash',
            'Class'              => 'classHash',
            'Combatant'          => 'combatantHash',
            'Destination'        => 'destinationHash',
            'DirectorBook'       => 'bookHash',
            'EnemyRace'          => 'raceHash',
            'Faction'            => 'factionHash',
            'Gender'             => 'genderHash',
            'GrimoireCard'       => 'cardId',
            'HistoricalStats'    => 'statId',
            'InventoryBucket'    => 'bucketHash',
            'InventoryItem'      => 'itemHash',
            'Place'              => 'placeHash',
            'Progression'        => 'progressionHash',
            'RecordBook'         => 'hash',
            'Record'             => 'hash',
            'Objective'          => 'objectiveHash',
            'Race'               => 'raceHash',
            'SandboxPerk'        => 'perkHash',
            'ScriptedSkull'      => 'skullHash',
            'SpecialEvent'       => 'eventHash',
            'Stat'               => 'statHash',
            'StatGroup'          => 'statGroupHash',
            'TalentGrid'         => 'gridHash',
            'UnlockFlag'         => 'flagHash',
            'VendorCategory'     => 'categoryHash',
            'Vendor'             => 'summary.vendorHash',
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
