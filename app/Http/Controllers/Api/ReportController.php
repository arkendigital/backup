<?php

namespace App\Http\Controllers\Api;

use App\ForumPost;
use App\Http\Controllers\Controller;
use App\ReportTopic;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(ForumPost $post)
    {
        request()->validate([
            'content' => 'required'
        ]);

        $topic = ReportTopic::create([
            'title' => 'Reported post in '.$post->thread->title.' by '. auth()->user()->profile->display_name,
            'author_id' => auth()->user()->id,
            'content_id' => $post->id,
            'content_type' => 'post'
        ]);

        $topic->posts()->create([
            'content' => request()->content,
            'user_id' => auth()->user()->id
        ]);

        // @todo fire event

        return response(['status' => 'success', 'report_id' => $topic->id], 200);
    }
}
