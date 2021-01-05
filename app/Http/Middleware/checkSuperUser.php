<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class checkSuperUser
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
        // dd(Auth::user()->superuser);
        if(Auth::user()->superuser || Auth::user()->isAdmin()) {
            return $next($request);
        } else {
            abort(401);
        }
    }
}
