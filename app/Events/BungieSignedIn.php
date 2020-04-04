<?php

namespace App\Events;

use App\Models\Bungie;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

/**
 * Class BungieSignedIn.
 */
class BungieSignedIn
{
    use Dispatchable;
    use InteractsWithSockets;
    use SerializesModels;

    /**
     * @var Bungie
     */
    public $bungie;

    /**
     * BungieSignedIn constructor.
     *
     * @param Bungie $bungie
     */
    public function __construct(Bungie $bungie)
    {
        $this->bungie = $bungie;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
