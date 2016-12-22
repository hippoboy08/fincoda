<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class SpecialMiddleware
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

        if(Auth::guest()){
            return redirect('/');
        }
        if(Auth::user()->hasRole('admin') || Auth::user()->hasRole('basic')){
            return redirect('403');
        }
        return $next($request);
    }
}
