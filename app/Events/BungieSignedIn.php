<?php

namespace App\Events;

use App\Models\Bungie;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;

/**
 * Class BungieSignedIn
 * @package App\Events
 */
class BungieSignedIn
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * @var Bungie
     */
    public $bungie;

    /**
     * BungieSignedIn constructor.
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
