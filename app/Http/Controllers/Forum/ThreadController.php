<?php

namespace App\Http\Controllers\Forum;

use App\Events\ForumPostCreated;
use App\Events\ForumThreadViewed;
use App\Events\ThreadCreated;
use App\Forum;
use App\ForumCategory;
use App\ForumPost;
use App\ForumThread as Thread;
use App\Http\Controllers\Controller;
use Auth;
use Event;
use Illuminate\Http\Request;
use Setting;

class ThreadController extends Controller
{
    /**
     * Initialize Controller.
     */
    public function __construct()
    {
        $this->middleware('auth', ['only' => 'create']);
        parent::__construct();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Forum $forum)
    {
        $this->seo()->setTitle('Create Thread &mdash; '.$this->seo()->getTitle());

        return view('threads.create', compact('forum'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Forum $forum, Request $request)
    {
        $thread = $forum->threads()->create(['title' => $request->title, 'user_id' => auth()->user()->id]);

        Event::fire(new ThreadCreated(Auth::user(), $thread));

        $post = $thread->posts()->create(['content' => $request->content, 'user_id' => auth()->user()->id]);

        Event::fire(new ForumPostCreated(Auth::user(), $post));

        alert()->success('Your thread has been posted!');

        return redirect('/forums/'.$thread->forum->slug.'/'.$thread->slug);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Forum $forum, Thread $thread)
    {
        if (!auth()->guest()) {
            if (!auth()->user()->hasAnyRole($thread->forum->roles)) {
                alert()->error('You do not have permission to view this thread!');
                return redirect()->route('forumIndex');
            }
        } else {
            if (!in_array('Guest', $thread->forum->roles)) {
                alert()->error('You do not have permission to view this thread!');
                return redirect()->route('forumIndex');
            }
        }

        $this->seo()->setTitle($thread->title.' &mdash; '.$this->seo()->getTitle());
        $postsPerPage = Setting::get('posts_per_page', 10);
        $posts = $thread->posts->load(['profile', 'user', 'editLog', 'reactions'])->paginate($postsPerPage);
        
        Event::fire(new ForumThreadViewed($thread));

        return view('threads.show', compact('thread', 'posts'));
    }

    /**
     * Delete a thread and all posts
     *
     * @param  Forum  $forum
     * @param  Thread $thread
     * @return Illuminate\Http\Response
     */
    public function destroy(Forum $forum, Thread $thread)
    {
        foreach ($thread->posts as $post) {
            $post->delete();
        }
        $thread->delete();

        return redirect()->route('forumIndex');
    }

    /**
     * Go to the last post in a thread
     *
     * @param  Forum     $forum
     * @param  Thread    $thread
     * @param  ForumPost $post
     * @return Illuminate\Http\Response
     */
    public function goToLastPost(Forum $forum, Thread $thread, ForumPost $post)
    {
        $postsPerPage = Setting::get('posts_per_page', 10);
        $posts = $thread->posts()->paginate($postsPerPage);

        return redirect('/forums/'.$forum->slug . '/' . $thread->slug . '?page=' . $posts->lastPage(). '#post-' . $post->id);
    }

    /**
     * Pin a thread
     *
     * @param  Thread $thread
     * @return Illuminate\Http\Response
     */
    public function pin(Forum $forum, Thread $thread)
    {
        if (!auth()->user()->isStaff()) {
            alert()->error('You do not have permission to do this');
            return back();
        }

        if ($thread->pinned == 1) {
            $thread->update(['pinned' => '0']);
            alert()->success('Thread Unpinned');
        } else {
            $thread->update(['pinned' => '1']);
            alert()->success('Thread Pinned');
        }

        return back();
    }

    /**
     * Close a thread
     *
     * @param  Thread $thread
     * @return Illuminate\Http\Response
     */
    public function close(Forum $forum, Thread $thread)
    {
        if (!auth()->user()->isStaff()) {
            alert()->error('You do not have permission to do this');
            return back();
        }

        if ($thread->status == 'open') {
            $thread->update(['status' => 'closed']);
            alert()->success('Thread Closed');
        } else {
            $thread->update(['status' => 'open']);
            alert()->success('Thread Reopened');
        }

        return back();
    }

    public function move(Forum $forum, Thread $thread)
    {
        if (!auth()->user()->isStaff()) {
            alert()->error('You do not have permission to do this');
            return back();
        }

        $this->seo()->setTitle($thread->title);
        $categories = ForumCategory::orderBy('position', 'ASC')->get();
        return view('threads.move', compact(['thread', 'categories']));
    }

    /**
     * Process the move
     *
     * @param  Request $request
     * @param  Forum   $forum
     * @param  Thread  $thread
     * @return Illuminate\Http\Response
     */
    public function processMove(Request $request, Forum $forum, Thread $thread)
    {
        if (!auth()->user()->isStaff()) {
            alert()->error('You do not have permission to do this');
            return back();
        }

        if ($thread->forum->id == $request->forum_id) {
            alert()->error('You cannot move a thread into the forum in which it already lives...');
            return back();
        }

        $thread->update([
            'forum_id' => $request->forum_id
        ]);

        alert()->success('Thread moved!');

        return redirect()->route('showThread', [$thread->fresh()->forum, $thread->fresh()]);
    }
}
