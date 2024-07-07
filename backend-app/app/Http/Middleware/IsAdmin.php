<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class IsAdmin
{
    public function handle($request, Closure $next)
    {
        if (Auth::check() && Auth::user()->is_admin) {
            Log::info('User is admin', ['user_id' => Auth::id()]);
            return $next($request);
        }

        Log::warning('User does not have admin access', ['user_id' => Auth::id()]);
        return redirect('/')->with('error', 'You do not have admin access.');
    }
}
