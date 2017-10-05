<?php

namespace App\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'App\Events\Event' => [
            'App\Listeners\EventListener',
        ],
        'App\Events\ExamFinishEvent' => [
            'App\Listeners\ExamFinishListener',
        ],
        'App\Events\QuestionStatusNextEvent' => [
            'App\Listeners\QuestionStatusNextListener',
        ],
        'App\Events\QuestionStatusSentEvent' => [
            'App\Listeners\QuestionStatusSentListener',
        ],
        'App\Events\StudentStatusOnlineEvent' => [
            'App\Listeners\StudentStatusOnlineListener',
        ],
        'App\Events\QuestionStatusAnsweredEvent' => [
            'App\Listeners\QuestionStatusAnsweredListener',
        ],
        'App\Events\QuestionCorrectAnswerSentEvent' => [
            'App\Listeners\QuestionCorrectAnswerSentListener',
        ],
        'App\Events\ExaminerStatusOnlineEvent' => [
            'App\Listeners\ExaminerStatusOnlineListener',
        ],
        'App\Events\TimeOutEvent' => [
            'App\Listeners\TimeOutListener',
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
