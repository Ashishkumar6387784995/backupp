<?php

namespace App\Http\Middleware;

use Closure;

class Checksession
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
        if (auth()->guard('admin')->check() && auth()->guard('admin')->user()->role_id == 1) {
            return $next($request);
        } else {
            auth()->guard('admin')->logout();
            $message = 'Invalid request, Access denied!.';
            return redirect('login')->withErrors([$message]);
        }
    }
}
