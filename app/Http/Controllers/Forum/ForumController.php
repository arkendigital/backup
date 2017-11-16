<?php

namespace App\Http\Controllers\Forum;

use App\Forum;
use App\ForumCategory;
use App\Http\Controllers\Controller;
use App\Session;
use Illuminate\Http\Request;
use Setting;

class ForumController extends Controller
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->seo()->setTitle('Forums');

        $categories = ForumCategory::with('forums')->orderBy('position', 'asc')->get();

        // $categories->each(function($category) {
        //     $category->forums->each(function($forum) {
        //         if ($forum->parent == 0) {
        //             // return $forum->load('threads');
        //         }
        //     });
        // });

        if (auth()->check()) {
            $onlineUsers = Session::usersByMinutes(10)->get();
        }

        return view('forums.index', compact(['categories', 'forums', 'onlineUsers']));
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Forum $forum)
    {
        if (!auth()->guest()) {
            if (!auth()->user()->hasAnyRole($forum->roles)) {
                alert()->error('You do not have permission to view this forum!');
                return redirect()->route('forumIndex');
            }
        } else {
            if (!in_array('Member', $forum->roles)) {
                alert()->error('You do not have permission to view this forum!');
                return redirect()->route('forumIndex');
            }
        }

        $this->seo()->setTitle($forum->name);
        
        $pinned = $forum->threads->where('pinned', 1)->paginate(10);
        $threadsPerPage = Setting::get('threads_per_page', 15);
        $threads = $forum->threads->sortByDesc(function ($thread) {
            return $thread->id;
        })->paginate($threadsPerPage);

        return view('forums.show', compact(['forum', 'threads', 'pinned']));
    }
}
