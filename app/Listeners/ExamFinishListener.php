<?php

namespace App\Listeners;

use App\Events\ExamFinishEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class ExamFinishListener
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
     * @param  ExamFinishEvent  $event
     * @return void
     */
    public function handle(ExamFinishEvent $event)
    {
        //
    }
}
