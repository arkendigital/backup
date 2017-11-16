<?php

namespace App\Http\Controllers\Admin;

use App\Forum;
use App\ForumPost;
use App\ForumThread;
use App\ForumCategory;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;

class ForumController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:create forum|edit forum|delete forum']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = ForumCategory::with('forums')->orderBy('position', 'asc')->paginate(20);

        return view('admin.forums.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Role $role)
    {
        $forums = Forum::orderBy('id', 'ASC')->pluck('name', 'id');
        $categories = ForumCategory::orderBy('id', 'ASC')->pluck('name', 'id');
        $roles = $role->all();

        return view('admin.forums.create', compact(['forums', 'categories', 'roles']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $forum = new Forum($request->all());
        $forum->save();

        return redirect()->route('forums.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Forum $forum, Role $role)
    {
        $forums = Forum::orderBy('id', 'ASC')->pluck('name', 'id');
        $categories = ForumCategory::orderBy('id', 'ASC')->pluck('name', 'id');
        $roles = $role->all();

        return view('admin.forums.edit', compact(['forum', 'forums', 'categories', 'roles']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int                      $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Forum $forum)
    {
        if ($request->roles == null) {
            $roles = [];
        } else {
            $roles = $request->roles;
        }

        $forum->update($request->all());
        $forum->update(['roles' => $roles]);

        alert()->success('Forum Updated!');

        return redirect()->route('forums.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Forum $forum)
    {
        foreach ($forum->threads as $thread) {
            $thread->delete();
        }

        $forum->delete();

        alert()->success('Forum Deleted!');

        return redirect()->route('forums.index');
    }

    public function resync(Forum $forum)
    {
        // if (($forum->last_thread_id) && ($forum->last_post_id) && ($forum->last_poster_id)) {
        //     alert()->info('Nothing to do!');
        //     return back();
        // }

        $thread = ForumThread::select('id')->where('forum_id', $forum->id)->orderBy('id', 'DESC')->first();
        if ($thread) {
            $post = ForumPost::select(['id', 'user_id', 'created_at'])->where('thread_id', $thread->id)->orderBy('id', 'DESC')->first();
            if ($post) {
                $forum->update([
                    'last_thread_id' => $thread->id,
                    'last_post_id' => $post->id,
                    'last_poster_id' => $post->user_id,
                    'updated_at' => $post->created_at
                ]);
                alert()->success('Last Post Info Resynchronized');
                return back();
            } else {
                alert()->info('No last post found');
                return back();
            }
        } else {
            alert()->info('No last thread found');
            return back();
        }

    }
}
