<?php

namespace App\Http\Controllers\Forum;

use App\Forum;
use App\ForumThread as Thread;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ThreadSubscriptionsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param int $forumId
     * @param \App\Thread $thread
     *
     * @return Model
     */
    public function store(Forum $forum, Thread $thread)
    {
        $thread->subscribe();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int  $forumId
     * @param \App\Thread $thread
     *
     * @return Model
     */
    public function destroy(Forum $forum, Thread $thread)
    {
        $thread->unsubscribe();
    }
}
