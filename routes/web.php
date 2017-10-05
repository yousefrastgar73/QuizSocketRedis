<?php
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', function () {
    return view('layouts.start');
});
Route::get('guide', function () {
    return view('layouts.guide');
});
Route::get('profile', [
    'uses'       => 'UsersController@showProfile',
    'as'         => 'student.profile'
]);
Route::post('profile', [
    'uses'       => 'UsersController@fetchScore',
    'as'         => 'student.score'
]);
Route::group(['prefix' => 'signup'], function () {
    Route::get('/', [
        'uses' => 'AuthController@showSignup',
        'as'   => 'auth.showSignup'
    ]);
    Route::post('/register', [
        'uses' => 'AuthController@signup',
        'as'   => 'auth.signup'
    ]);
});
Route::get('login', [
    'uses' => 'AuthController@showLogin',
    'as'   => 'auth.showLogin'
]);
Route::post('login', [
    'uses' => 'AuthController@login',
    'as'   => 'auth.login'
]);
Route::get('logout', [
    'uses' => 'AuthController@logout',
    'as'   => 'auth.logout'
]);
Route::group(['prefix' => 'examiner', 'middleware' => 'examiner.auth'], function () {
    Route::get('/', [
        'uses' => 'ExaminersController@index',
        'as'   => 'examiner.index'
    ]);
    Route::post('/set-online', [
        'uses' => 'ExaminersController@setExaminerOnline',
        'as'   => 'examiner.setOnline'
    ]);
    Route::post('/send-question', [
        'uses' => 'ExaminersController@sendQuestion',
        'as'   => 'examiner.send'
    ]);
    Route::post('/send-correct', [
        'uses' => 'ExaminersController@sendCorrectAnswer',
        'as'   => 'examiner.correct'
    ]);
});
Route::group(['prefix' => 'questions', 'middleware' => 'student.auth'], function () {
    Route::get('/', [
        'uses' => 'QuestionsController@index',
        'as'   => 'questions.index'
    ]);
    Route::post('/status', [
        'uses' => 'QuestionsController@examinerStatus',
        'as'   => 'questions.status'
    ]);
    Route::post('/set-status', [
        'uses' => 'QuestionsController@setStartExamFlag',
        'as'   => 'questions.set'
    ]);
    Route::post('/fetch-question', [
        'uses' => 'QuestionsController@fetchQuestion',
        'as'   => 'questions.fetch'
    ]);
    Route::post('/time-out', [
        'uses' => 'QuestionsController@timeOut',
        'as'   => 'questions.time'
    ]);
    Route::post('/send-answer', [
        'uses' => 'QuestionsController@sendAnswer',
        'as'   => 'questions.send'
    ]);
    Route::post('/fetch-answer', [
        'uses' => 'QuestionsController@fetchAnswer',
        'as'   => 'questions.answer'
    ]);
    Route::post('/next-question', [
        'uses' => 'QuestionsController@nextQuestion',
        'as'   => 'questions.next'
    ]);
});
Route::get('finish', function () {
    return view('layouts.finish');
});
Route::post('clear-cache', [
    'uses' => 'QuestionsController@clearCache',
    'as'   => 'questions.clear'
]);
