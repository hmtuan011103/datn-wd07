<?php

namespace App\Listeners;

use App\Events\SelectSeat;
use App\Events\SelectSeatApp;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class BroadcastSelectSeat
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(SelectSeatApp $event): void
    {
        broadcast(new SelectSeat($event));
    }
}
