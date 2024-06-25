<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class ManagerMiddleware
{
    public function handle($request, Closure $next)
    {
        if (Auth::check() && (Auth::user()->role === 'manager' || Auth::user()->role === 'admin')) {
            return $next($request);
        }

        return redirect('/home')->with('error', 'You do not have manager access.');
    }
}
