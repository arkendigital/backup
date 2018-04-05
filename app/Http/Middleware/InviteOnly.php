<?php

namespace App\Http\Middleware;

use Closure;
use Route;

class InviteOnly
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
        if (auth()->guest()) {
            if (request()->isMethod('post')) {
                return $next($request);
            }

            if (!in_array(request()->route()->getName(), ['checkInvite', 'registerInvitedUser', 'verifyEmail', 'mailTracker_l', 'login', 'password.request', 'password.reset'])) {
                if ((\App\Setting::get('invite-only') == 1) || (env('INVITE_ONLY') == 1)) {
                    return response(view('invites.invite-only'));
                }
            }
        }
        return $next($request);
    }
}
