<?php

namespace App;

use App\Notifications\ThreadWasUpdated;
use Illuminate\Database\Eloquent\Model;

class ForumThreadSubscription extends Model
{
    protected $fillable = ['user_id', 'thread_id'];

    /**
     * A thread subscription belongs to a user
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * A thread subscription belongs to a thread
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function thread()
    {
        return $this->belongsTo(ForumThread::class);
    }

    /**
     * Notify a user who is subscribed to a thread
     *
     * @return App\Notifications\ThreadWasUpdated
     */
    public function notify($post)
    {
        $this->user->notify(new ThreadWasUpdated($this->thread, $post));
    }
}
