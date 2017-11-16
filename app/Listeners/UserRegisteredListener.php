<?php

namespace App\Listeners;

use App\Events\UserRegistered;

class UserRegisteredListener
{
    /**
     * Handle the event.
     *
     * @param UserRegistered $event
     */
    public function handle(UserRegistered $event)
    {
        // Send a welcome email / PM / whatever

        // Do something else here.. set a flag to prompt for info.. etc.

        // create user XP row
        // $event->user->xp()->create([]);
        // Give user XP for registering
        // $event->user->xp()->increment('points', 50);
    }
}
