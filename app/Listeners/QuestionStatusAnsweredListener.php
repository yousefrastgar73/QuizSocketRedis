<?php

namespace App\Listeners;

use App\Events\QuestionStatusAnsweredEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class QuestionStatusAnsweredListener
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
     * @param  QuestionStatusAnsweredEvent  $event
     * @return void
     */
    public function handle(QuestionStatusAnsweredEvent $event)
    {
        //
    }
}
