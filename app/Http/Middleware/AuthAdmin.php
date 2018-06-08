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
           //dd(urlencode($request->getRequestUri())) ;
            //return redirect('indexAdmin');
            return redirect()->guest(route('indexAdmin',["next"=>$request->getRequestUri()]));
            //return redirect('/admin');
            //return redirect()->route('indexAdmin');
        }
        return $next($request);
    }
}
