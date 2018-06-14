<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AuthAdminAgence
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
        if(!Auth::check())
        {
            return redirect()->guest(route('indexAdmin',["next"=>$request->getRequestUri()]));
        }
        return $next($request);
    }
}
