<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class QuestionCorrectAnswerSentEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    
//    public $correctAnswer;
//    public $correctNumber;
//    public $notAnswered;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct()
    {
//        $this->correctNumber = $correctNumber;
//        $this->correctAnswer = $correctAnswer;
//        $this->notAnswered   = $notAnswered;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        return ['quiz'];
    }
    
    /**
     * Get the data to broadcast.
     *
     * @return array
     */
//    public function broadcastWith()
//    {
//        return [
//            'correctNumber' => $this->correctNumber,
//            'correctAnswer' => $this->correctAnswer,
//            'notAnswered'   => $this->notAnswered
//        ];
//    }
    
    public function broadcastAs()
    {
        return 'correct';
    }
}
