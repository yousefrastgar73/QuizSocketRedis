<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Cartalyst\Sentinel\Sentinel;

class ExaminerMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    function __construct(Sentinel $sentinel)
    {
     $this->sentinel = $sentinel;
    }
    public function handle($request, Closure $next)
    {
        $user = $this->sentinel->getUser();
        if (!($user && $user->inRole($this->sentinel->getRoleRepository()->findByName('examiner')))) {
          return redirect()->route('auth.login');
        }
        return $next($request);
    }
}
