<?php

namespace App\Http\Controllers\Profile;

use App\Profile;
use App\ForumPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class ProfileController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param \App\Profile $profile
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Profile $profile)
    {
        $this->seo()->setTitle($profile->display_name);

        $posts = ForumPost::select('id', 'thread_id', 'user_id', 'content')
                        ->with('thread')
                        ->where('user_id', $profile->user_id)
                        ->whereNull('deleted_at')
                        ->orderBy('id', 'DESC')
                        ->take(6)
                        ->get();

        return view('profiles.show', compact(['profile','posts']));
    }

    /**
     * Follow the specified user
     * 
     * @param  \App\Profile $profile
     * @return Illuminate\Http\Response
     */
    public function follow(Profile $profile)
    {
        $profile->watch();
        alert()->success('You are now following '. $profile->display_name);
        return back();
    }

    /**
     * Unfollow the specified user
     * 
     * @param  \App\Profile $profile
     * @return Illuminate\Http\Response
     */
    public function unfollow(Profile $profile)
    {
        $profile->unwatch();
        alert()->info('You are no longer following '. $profile->display_name);
        return back();
    }
}
