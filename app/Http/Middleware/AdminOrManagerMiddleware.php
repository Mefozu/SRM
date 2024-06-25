<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AdminOrManagerMiddleware
{
    public function handle($request, Closure $next)
    {
        if (Auth::check() && (Auth::user()->role === 'admin' || Auth::user()->role === 'manager')) {
            return $next($request);
        }

        return redirect('/home')->with('error', 'You do not have sufficient access.');
    }
}
