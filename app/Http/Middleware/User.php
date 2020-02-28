<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class User
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
        if (Auth::check() && Auth::user()->role == ROLE_USER) {
            return $next($request);
        } elseif (Auth::check() && Auth::user()->role == ROLE_ADMIN) {
            return redirect()->route('admin.dashboard');
        } else {
            return redirect()->route('login');
        }
    }
}
