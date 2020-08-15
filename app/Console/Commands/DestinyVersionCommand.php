<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class DestinyVersionCommand extends Command
{
    protected $signature = 'destiny:version';
    protected $description = 'Update version number.';

    public function handle()
    {
        $old = version();
        $new = version(true);

        $this->comment('Previous: '.$old.' New: '.$new);

        if ($old !== $new && \App::environment() === 'production') {
            $this->call('bugsnag:deploy', ['--revision' => $new]);
        }

        return 0;
    }
}
