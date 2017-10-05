<?php

namespace App\Listeners;

use App\Events\ExaminerStatusOnlineEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class ExaminerStatusOnlineListener
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
     * @param  ExaminerStatusOnlineEvent  $event
     * @return void
     */
    public function handle(ExaminerStatusOnlineEvent $event)
    {
        //
    }
}
