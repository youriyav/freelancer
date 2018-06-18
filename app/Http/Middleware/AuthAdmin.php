<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AuthAdmin
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
        if(!Auth::check())
        {
            return redirect()->guest(route('loginAdmin',["next"=>$request->getRequestUri()]));
        }
        if(Auth::user()->isAdmin!=1)
        {
            Auth::logout();
            return redirect()->guest(route('loginAdmin',["next"=>$request->getRequestUri()]));
        }
        return $next($request);
    }
}
