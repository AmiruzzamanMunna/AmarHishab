<?php

namespace App\Http\Middleware;

use Closure;

class UserSess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!$request->session()->get('loggedUser')) {

            return redirect()->route('user.userLoginPage');
        }
        return $next($request);
    }
}
