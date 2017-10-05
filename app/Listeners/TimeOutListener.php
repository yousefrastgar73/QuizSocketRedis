<?php

namespace App\Listeners;

use App\Events\TimeOutEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class TimeOutListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  TimeOutEvent  $event
     * @return void
     */
    public function handle(TimeOutEvent $event)
    {
        //
    }
}
