<?php

namespace App\Http\Middleware;

use Closure;

class Candidatesession
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
        // dd($request);
        if ($request->session()->get('id') && $request->session()->get('email') && $request->session()->get('access_name') == 'candidate') {
            return $next($request);
        }else{
            return redirect('signin');
        }
    }
}
