<?php

namespace App\Http\Controllers;

use Cartalyst\Sentinel\Sentinel;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Database\Connection;
use App\Events\ExamFinishEvent;

class UsersController extends Controller
{
    function __construct(Sentinel $sentinel, Connection $connection)
    {
      $this->middleware('student.auth');
      $this->sentinel = $sentinel;
      $this->connection = $connection;
    }
    
    public function showProfile()
    {
       return view('layouts.profile');
    }
    
    public function fetchScore(Request $request)
    {
        $score = $request->except('_token');
        $score = $score['totalScore'];
        $userID = $this->sentinel->getUser()->id;
        $this->connection->table('users')->where('id', $userID)->update(['total_score' => $score]);
        event(new ExamFinishEvent());
        return response()->json('score updated');
    }
}
