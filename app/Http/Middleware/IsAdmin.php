<?php

namespace App\Http\Middleware;

use Closure;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure                 $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (auth()->user() && auth()->user()->hasRole('Super Administrator|Files Administrator|Forum Administrator')) {
            return $next($request);
        }

        alert()
            ->error('Sorry! You need to be an administrator to perform this action.')
            ->autoclose(5000);

        return redirect(route('index'));
    }
}
