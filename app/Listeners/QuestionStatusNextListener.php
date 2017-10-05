<?php

namespace App\Listeners;

use App\Events\QuestionStatusNextEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class QuestionStatusNextListener
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
     * @param  QuestionStatusNextEvent  $event
     * @return void
     */
    public function handle(QuestionStatusNextEvent $event)
    {
        //
    }
}
