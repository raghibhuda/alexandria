<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  Request  $request
     * @param Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::check() && Auth::user()->role == ROLE_ADMIN) {
            return $next($request);
        } elseif (Auth::check() && Auth::user()->role == ROLE_USER) {
            return redirect()->route('user.dashboard');
        } else {
            return redirect()->route('login');
        }
    }
}
