<?php

namespace App\Http\Controllers;

use App\Events\QuestionStatusAnsweredEvent as QuestionAnswered;
use App\Events\StudentStatusOnlineEvent as StudentOnline;
use App\Events\QuestionStatusNextEvent as QuestionNext;
use App\Events\TimeOutEvent as TimeOut;
use App\Events\ExamFinishEvent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use App\Repositories\QuestionRepository as Question;
use App\Repositories\AnswerRepository as Answer;
use Cache;

class QuestionsController extends Controller
{
    
    public function index()
    {
        return view('layouts.questions');
    }
    
    public function examinerStatus()
    {
        $status = Redis::get('examiner');
        if ($status == 'examinerOnline')
        {
            return response()->json('examinerOnline');
        }
        else
        {
            return response()->json('examinerOffline');
        }
    }
    
    public function setStartExamFlag()
    {
        Redis::set('examinee', 'online');
        event(new StudentOnline());
        return response()->json('online');
    }

    public function fetchQuestion(Request $request)
    {
        $id = $request->input('id');
        $question = Question::find($id);
        return response()->json($question);
    }
    
    public function timeOut()
    {
        event(new TimeOut());
        return 'timeOut';
    }
    
    public function sendAnswer(Request $request)
    {
        $selected_answer = $request->input('option');
        event(new QuestionAnswered($selected_answer));
        return response()->json($selected_answer);
    }
    
    public function fetchAnswer(Request $request)
    {
        $id = $request->input('id');
        $answer = Answer::find($id);
        return response()->json($answer);
    }
    
    public function nextQuestion()
    {
        Redis::set('question', 'next');
        event(new QuestionNext());
        return response()->json('next');
    }
    
    public function clearCache()
    {
        Cache::flush();
        event(new ExamFinishEvent());
        return response()->json('Cache Cleared');
    }
}
