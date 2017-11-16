<?php

namespace App\Listeners;

use App\Events\ThreadCreated;

class ThreadCreatedListener
{
    /**
     * Handle the event.
     *
     * @param ThreadCreated $event
     */
    public function handle(ThreadCreated $event)
    {
        $event->user->profile()->increment('thread_count', 1);
        $event->user->xp()->increment('points', 25);
    }
}
