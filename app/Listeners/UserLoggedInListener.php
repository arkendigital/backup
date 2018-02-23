<?php

namespace App\Listeners;

class UserLoggedInListener
{
    /**
     * Handle the event.
     *
     * @param UserLoggedIn $event
     */
    public function handle($event)
    {
        // Set latest user IP..
        // $event->user->update(['ip_address', \Request::getClientIp()]);

        // Give user XP for logging in
        // touches the user table so also updates latest activity
        // $event->user->xp()->increment('points', 1);
    }
}
