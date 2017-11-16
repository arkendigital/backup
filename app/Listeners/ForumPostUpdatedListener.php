<?php

namespace App\Listeners;

use App\Events\ForumPostUpdated;

class ForumPostUpdatedListener
{
    /**
     * Handle the event.
     *
     * @param ForumPostCreated $event
     */
    public function handle(ForumPostUpdated $event)
    {
        $event->post->editLog()->create([
            'content' => $event->post->content,
            'user_id' => $event->user->id,
        ]);
    }
}
