<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use App\Http\Requests;
use App\Models\User;
use Cartalyst\Sentinel\Sentinel;

class AuthController extends Controller
{
  function __construct(Sentinel $sentinel)
  {
    $this->sentinel = $sentinel;
  }

  public function showSignup()
  {
      if ($this->sentinel->check()) {
          return redirect('/');
      }
      else {
          return view('auth.signup');
      }
  }
  
  public function signup(Request $signupRequest)
  {
      $this->validate($signupRequest, [
          'username'      => 'required|unique:users|max:20',
          'first_name'    => 'required|max:40',
          'last_name'     => 'required|max:40',
          'email'         => 'required|email',
          'password'      => 'required',
          'phone_number' => 'required|unique:users|regex:/^09[0-9]{9}$/'
      ]);
      $credentials = $signupRequest->except('_token');
      try
      {
          $user = $this->sentinel->registerAndActivate($credentials);
          $role = $this->sentinel->findRoleByName('student');
          $role->users()->attach($user);
          return redirect()->back()->with('success', 'ثبت نام شما با موفقیت انجام شد');
      }
      catch (QueryException $e)
      {
          return redirect()->back()->with('fail', 'کاربر با اطلاعات ورودی وجود دارد');
      }
  }
  
  public function showLogin()
  {
      if ($this->sentinel->check()) {
          return redirect('/');
      }
      else {
          return view('auth.login');
      }
  }
  public function login(Request $loginRequest)
  {
      $this->validate($loginRequest, [
          'username' => 'required',
          'password' => 'required'
      ]);
      $credentials = $loginRequest->except('_token');
      $role = $this->sentinel->getRoleRepository()->findByName('examiner');
      $user = $this->sentinel->authenticate($credentials);
      if (!$user) {
          return redirect()->back()->with('status', 'کاربر با اطلاعات ورودی وجود ندارد !');
      }
      elseif ($user && $user->inRole($role)) {
          return redirect()->route('examiner.index');
      }
      else {
          return redirect()->route('student.profile');
      }
  }
  
  public function logout()
  {
    $this->sentinel->logout();
    return redirect()->route('auth.showLogin');
  }
}
