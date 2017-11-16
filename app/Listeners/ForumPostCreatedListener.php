<?php

namespace App\Listeners;

use App\Events\ForumPostCreated;

class ForumPostCreatedListener
{
    /**
     * Handle the event.
     *
     * @param ForumPostCreated $event
     */
    public function handle(ForumPostCreated $event)
    {
        $event->user->profile()->increment('post_count', 1);
        $event->user->xp()->increment('points', 10);
        if (!$event->post->thread->post_count) {
            $event->post->thread()->update(['post_count' => 1]);
        } else {
            $event->post->thread()->increment('post_count');
        }
    }
}
