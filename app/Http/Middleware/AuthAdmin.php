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
            return redirect()->guest(route('indexAdmin',["next"=>$request->getRequestUri()]));
        }
        if(Auth::user()->isAdmin!=2)
        {
            return redirect()->guest(route('indexAdmin',["next"=>$request->getRequestUri()]));
        }
        return $next($request);
    }
}
