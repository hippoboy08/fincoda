<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

class ExternalMiddleware
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

        if(Auth::user()->hasRole('special') || Auth::user()->hasRole('admin') || Auth::user()->hasRole('basic')){
            return redirect('403');
        }
        return $next($request);
    }
}
