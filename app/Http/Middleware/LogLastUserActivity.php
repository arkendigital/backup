<?php

namespace App\Http\Middleware;

use Carbon\Carbon;
use Cache;
use Closure;

class LogLastUserActivity
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
        if (auth()->user()) {
            $expiresAt = Carbon::now()->addMinutes(1);
            Cache::put('user-is-online-'.auth()->user()->id, true, $expiresAt);
        }

        return $next($request);
    }
}
