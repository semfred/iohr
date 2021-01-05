<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class firstTimeLogin
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
        if(!Auth::user()->password_changed)
        {
            return redirect()
                        ->route('web.profile.changepassword');
        }
        return $next($request);
    }
}
