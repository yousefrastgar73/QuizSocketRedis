<?php

namespace App\Listeners;

use App\Events\QuestionCorrectAnswerSentEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class QuestionCorrectAnswerSentListener
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
     * @param  QuestionCorrectAnswerSentEvent  $event
     * @return void
     */
    public function handle(QuestionCorrectAnswerSentEvent $event)
    {
        //
    }
}
