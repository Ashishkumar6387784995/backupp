<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CompanyMiddleware
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
        if (auth()->guard('company')->check() && auth()->guard('company')->user()->role_id == 2) {
            return $next($request);
        } else {
            auth()->guard('company')->logout();
            return redirect("company/login")->withErrors(['error' => 'Invalid request, Access denied!']);
        }
        
    }
}
