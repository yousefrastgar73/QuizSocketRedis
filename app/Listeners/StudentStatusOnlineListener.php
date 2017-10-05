<?php

namespace App\Listeners;

use App\Events\StudentStatusOnlineEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class StudentStatusOnlineListener
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
     * @param  StudentStatusOnlineEvent  $event
     * @return void
     */
    public function handle(StudentStatusOnlineEvent $event)
    {
        //
    }
}
