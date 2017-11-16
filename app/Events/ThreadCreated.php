<?php

namespace App\Events;

use App\ForumThread;
use App\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ThreadCreated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $thread;
    public $user;
    /**
     * Create a new event instance.
     */
    public function __construct(User $user, ForumThread $thread)
    {
        $this->user = $user;
        $this->thread = $thread;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
