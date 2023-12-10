<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class SelectSeat implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $seat;
    /**
     * Create a new event instance.
     */
    public function __construct($seat)
    {
        $this->seat = $seat;
    }


    public function broadcastOn()
    {
        return new Channel('select-seat');
    }

    public function broadcastWith()
    {
        return [
            'seat' => $this->seat,
        ];
    }
}
