<?php

namespace App\Listeners;

use App\Events\ForumThreadViewed;
use Cache;
use Carbon\Carbon;

class ForumThreadViewedListener
{
    /**
     * Handle the event.
     *
     * @param ForumPostViewed $event
     */
    public function handle(ForumThreadViewed $event)
    {
        if (!Cache::get('viewed-threads['.$event->thread->id.']')) {
            $expiresAt = Carbon::now()->addWeeks(1);
            Cache::put('viewed-threads['.$event->thread->id.']', true, $expiresAt);
            $event->thread->timestamps = false;

            if (!$event->thread->view_count) {
                $event->thread->update(['view_count' => 1]);
            } else {
                $event->thread->increment('view_count');
            }
        }
    }
}
