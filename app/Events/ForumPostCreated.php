<?php

namespace App\Events;

use App\ForumPost;
use App\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ForumPostCreated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $user;
    public $post;
    
    /**
     * Create a new event instance.
     */
    public function __construct(User $user, ForumPost $post)
    {
        $this->user = $user;
        $this->post = $post;
    }
}
