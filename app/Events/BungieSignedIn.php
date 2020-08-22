<?php

namespace App\Events;

use App\Models\Bungie;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class BungieSignedIn
{
    use Dispatchable;
    use InteractsWithSockets;
    use SerializesModels;

    public Bungie $bungie;

    public function __construct(Bungie $bungie)
    {
        $this->bungie = $bungie;
    }
}
