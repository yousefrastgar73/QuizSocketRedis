<?php

namespace App\Repositories;

use Illuminate\Support\Facades\Redis;

class QuestionRepository
{
    function __construct ($id='', $question_text='', $option1='', $option2='', $option3='', $option4='', $score='', $correct_answer='')
    {
        $this->id             = $id;
        $this->question_text  = $question_text;
        $this->option1        = $option1;
        $this->option2        = $option2;
        $this->option3        = $option3;
        $this->option4        = $option4;
        $this->score          = $score;
        $this->correct_answer = $correct_answer;
    }
    public function store()
    {
        Redis::hmset('question:' . $this->id,
            [
                'id'             => $this->id,
                'question_text'  => $this->question_text,
                'option1'        => $this->option1,
                'option2'        => $this->option2,
                'option3'        => $this->option3,
                'option4'        => $this->option4,
                'score'          => $this->score,
                'correct_answer' => $this->correct_answer
            ]);
    }
    public static function find($id)
    {
        $key = 'question:' . $id;
        $stored = Redis::hgetall($key);
        if (!empty($stored))
        {
            $question = new QuestionRepository(
                $stored['id'],
                $stored['question_text'],
                $stored['option1'],
                $stored['option2'],
                $stored['option3'],
                $stored['option4'],
                $stored['score'],
                $stored['correct_answer']
            );
            return $question;
        }
        return false;
    }
    public static function getAll()
    {
        $keys = Redis::keys('question:*');
        $questions = [];
        foreach ($keys as $key)
        {
            $stored = Redis::hgetall($key);
            $question = new QuestionRepository(
                $stored['id'],
                $stored['question_text'],
                $stored['option1'],
                $stored['option2'],
                $stored['option3'],
                $stored['option4'],
                $stored['score'],
                $stored['correct_answer']
            );
            $questions[] = $question;
        }
        return json_encode($questions);
    }
}
