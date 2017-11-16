<?php

namespace App\Http\Controllers\Api;

use App\ForumPost;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ForumPostController extends Controller
{
    public function show(ForumPost $post)
    {
        \Debugbar::disable();
        return $post->content;
    }
}
