<?php

namespace App\Http\Controllers\Forum;

use App\Events\ForumPostCreated;
use App\Events\ForumPostUpdated;
use App\Forum;
use App\ForumPost;
use App\ForumThread as Thread;
use App\Http\Controllers\Controller;
use App\Rules\Html;
use App\Setting;
use Auth;
use Event;
use Illuminate\Http\Request;
use Vamsi\HTMLToBBCode\HtmlConverter as HTMLToBBCode;

class PostController extends Controller
{
    /**
     * Initialize Controller.
     */
    public function __construct()
    {
        $this->middleware('auth');
        parent::__construct();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Forum $forum, Thread $thread, Request $request)
    {
        $post = $thread->posts()->create(['content' => $request->content, 'user_id' => auth()->user()->id]);

        $thread->subscriptions->filter(function ($sub) use ($post) {
            return $sub->user_id != $post->user_id;
        })->each->notify($post);

        Event::fire(new ForumPostCreated(Auth::user(), $post));

        alert()->success('Your reply has been posted!');

        $postsPerPage = Setting::get('posts_per_page', 10);
        $thread->load('posts');
        $posts = $thread->posts->paginate($postsPerPage);

        return redirect('/forums/'.$forum->slug . '/' . $thread->slug . '?page=' . $posts->lastPage(). '#post-' . $post->id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Forum $forum, Thread $thread, ForumPost $forumpost)
    {
        $this->seo()->setTitle('Edit Post');
        return view('forums.posts.edit', compact(['forum', 'thread', 'forumpost']));
    }

    /**
     * Update forum posts
     *
     * @param  Forum     $forum
     * @param  Thread    $thread
     * @param  ForumPost $forumpost
     * @return Illuminate\Http\Response
     */
    public function update(Forum $forum, Thread $thread, ForumPost $forumpost)
    {
        request()->validate(['content' => 'required', new Html]);
        Event::fire(new ForumPostUpdated(Auth::user(), $forumpost));
        $forumpost->update(request()->only('content'));
        alert()->success('Your message has been updated!');

        return redirect()->route('showThread', [$forum, $thread, 'page' => request()->only('lastPage')]);
    }

    /**
     * Delete a post
     *
     * @param  Forum     $forum
     * @param  Thread    $thread
     * @param  ForumPost $forumpost
     * @return Illuminate\Http\Response
     */
    public function destroy(Forum $forum, Thread $thread, ForumPost $forumpost)
    {
        $forumpost->user->xp()->decrement('points', 10);
        $thread->decrement('post_count', 1);
        // @todo change to event
        $forumpost->delete();
        return back();
    }
}
