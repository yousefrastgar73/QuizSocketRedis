<?php

namespace App\Repositories;

use Illuminate\Support\Facades\Redis;

class AnswerRepository
{
    function __construct ($id='', $correctNumber='', $correctAnswer='', $notAnswered='')
    {
        $this->id            = $id;
        $this->correctNumber = $correctNumber;
        $this->correctAnswer = $correctAnswer;
        $this->notAnswered   = $notAnswered;
    }
    public function store()
    {
        Redis::hmset('answer:' . $this->id,
            [
                'id'             => $this->id,
                'correct_number' => $this->correctNumber,
                'correct_answer' => $this->correctAnswer,
                'not_answered'   => $this->notAnswered
            ]);
    }
    public static function find($id)
    {
        $key = 'answer:' . $id;
        $stored = Redis::hgetall($key);
        if (!empty($stored))
        {
            $answer = new AnswerRepository(
                $stored['id'],
                $stored['correct_number'],
                $stored['correct_answer'],
                $stored['not_answered']
            );
            return $answer;
        }
        return false;
    }
    public static function getAll()
    {
        $keys = Redis::keys('answer:*');
        $answers = [];
        foreach ($keys as $key)
        {
            $stored = Redis::hgetall($key);
            $answer = new AnswerRepository(
                $stored['id'],
                $stored['correct_number'],
                $stored['correct_answer'],
                $stored['not_answered']
            );
            $answers[] = $answer;
        }
        return json_encode($answers);
    }
}
