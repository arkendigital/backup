<?php

namespace App\Http\Controllers\Forum;

use App\ForumThread;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class ForumSearchController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $this->seo()->setTitle('Search');

        $query = request()->q;

        if ($query) {
            $this->seo()->setTitle('Search Results for '.$query);
            $threads = ForumThread::search($query)->get();
        } else {
            $threads = collect();
        }

        return view('forums.search.show', compact('threads'));
    }

    public function latestThreads()
    {
        $this->seo()->setTitle('Latest Forum Activity');
        $threads = ForumThread::with(['forum', 'profile'])->orderBy('updated_at', 'desc')->paginate(30);

        return view('forums.search.latest', compact('threads'));
    }

    public function popularThreads()
    {
        $this->seo()->setTitle('Popular Forum Activity');
        $threads = ForumThread::with(['forum', 'profile'])->orderBy('post_count', 'desc')->orderBy('view_count', 'desc')->take(50)->get();

        return view('forums.search.popular', compact('threads'));
    }
}
