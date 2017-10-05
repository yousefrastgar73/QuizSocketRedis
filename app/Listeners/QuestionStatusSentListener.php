<?php

namespace App\Listeners;

use App\Events\QuestionStatusSentEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class QuestionStatusSentListener
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
     * @param  QuestionStatusSentEvent  $event
     * @return void
     */
    public function handle(QuestionStatusSentEvent $event)
    {
        //
    }
}
