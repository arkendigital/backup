<?php

namespace App\Http\Middleware;

use Closure;

class IsBanned
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
        if (auth()->check()) {
            if (auth()->user()->banned == 1) {
                return response(view('banned'));
            }
        }
        return $next($request);
    }
}
