<?php

namespace App\Http\Controllers\Discussion;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\DiscussionReply as DiscussionReplyRequest;
use App\Models\Discussion;
use App\Models\DiscussionCategory;
use App\Models\DiscussionReply;

class DiscussionReplyController extends Controller
{

    /**
     * Store a new reply in database storage.
     *
     * @param DiscussionCategory $category
     * @param Discussion $discussion
     * @param DiscussionReplyRequest $request
     *
     */
    public function store(DiscussionCategory $category, Discussion $discussion, DiscussionReplyRequest $request)
    {

        /**
        * Store reply in database storage.
        */
        $reply = DiscussionReply::create([
            "discussion_id" => $discussion->id,
            "user_id" => auth()->user()->id,
            "content" => request()->content
        ]);

        // return view("discussion.partials.reply", compact("reply"));

        /**
         * Redirect back to the discussion,
         * with a front end popup
         *
         */
        return redirect("/discussion/".$category->slug."/".$discussion->slug)->with([
            "alert" => true,
            "alert_title" => "Success",
            "alert_message" => "Your reply has been posted!",
            "alert_button" => "OK"
        ]);
    }
}
