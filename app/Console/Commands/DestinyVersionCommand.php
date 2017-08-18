<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

/**
 * Class DestinyVersionCommand.
 */
class DestinyVersionCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $signature = 'destiny:version';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update version number.';

    /**
     * Create a new command instance.
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
        $old = version();
        $new = version(true);

        $this->comment('Previous: '.$old.' New: '.$new);

        if ($old !== $new && \App::environment() === 'production') {
            $this->call('bugsnag:deploy', ['--revision' => $new]);
        }
    }
}