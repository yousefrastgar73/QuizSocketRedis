<?php

namespace App\Http\Controllers;

use App\Events\QuestionStatusSentEvent as QuestionSent;
use App\Events\QuestionCorrectAnswerSentEvent as CorrectAnswer;
use App\Events\ExaminerStatusOnlineEvent as ExaminerOnline;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use App\Repositories\QuestionRepository as Question;
use App\Repositories\AnswerRepository as Answer;
use Cache;

class ExaminersController extends Controller
{
    public function index()
    {
        return view('layouts.examiner');
    }
    
    public function setExaminerOnline()
    {
        Redis::set('examiner', 'examinerOnline');
        event(new ExaminerOnline());
        return response()->json('examinerOnline');
    }
    
    public function sendQuestion(Request $request)
    {
        $this->validate($request, [
            'id'             => 'required|numeric|max:15',
            'question_text'  => 'required|string',
            'option1'        => 'required|string',
            'option2'        => 'required|string',
            'option3'        => 'required|string',
            'option4'        => 'required|string',
            'score'          => 'required|numeric',
        ]);
        $questionArray = new Question(
            $request->input('id'),
            $request->input('question_text'),
            $request->input('option1'),
            $request->input('option2'),
            $request->input('option3'),
            $request->input('option4'),
            $request->input('score')
        );
        $questionArray->store();
        event(new QuestionSent());
        return response()->json('sent');
    }
    
    public function sendCorrectAnswer(Request $request)
    {
        $this->validate($request, [
            'id'             => 'required|numeric|max:15',
            'correct_number' => 'required|numeric',
            'correct_answer' => 'required|string'
        ]);
        $answerArray = new Answer(
            $request->input('id'),
            $request->input('correct_number'),
            $request->input('correct_answer'),
            $request->input('not_answered')
        );
        $answerArray->store();
        event(new CorrectAnswer());
        return response()->json('correct');
    }
}
