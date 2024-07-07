<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class SessionTimeoutMiddleware
{
    protected $timeout = 600; // 10 minutes in seconds

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!Session::has('lastActivityTime')) {
            Session::put('lastActivityTime', time());
        } elseif (time() - Session::get('lastActivityTime') > $this->timeout) {
            Session::forget('lastActivityTime');
            Auth::logout();

            return redirect()->route('login')->withErrors(['You have been inactive for too long.']);
        }

        Session::put('lastActivityTime', time());

        return $next($request);
    }
}
