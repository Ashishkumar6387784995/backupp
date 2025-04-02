<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class UserMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (auth()->guard('user')->check() && auth()->guard('user')->user()->role_id == 3) {
            return $next($request);
        } else {
            auth()->guard('user')->logout();
            return redirect("login")->withErrors(['error' => 'Invalid request, Access denied!']);
        }
    }
}
