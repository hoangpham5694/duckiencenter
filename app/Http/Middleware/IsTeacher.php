<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
class IsTeacher
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = 'teachers')
    {
        if(!Auth::guard($guard)->check()  ) {
          //  return redirect()->guest('login');
           // return redirect()->to('role-error');
             return response('Unauthorized.', 401);
        }
        return $next($request);
    }
}
