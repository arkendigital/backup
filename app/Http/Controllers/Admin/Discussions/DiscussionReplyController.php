<?php

namespace App\Http\Controllers\Admin\Discussions;

use App\Http\Controllers\Controller;
use App\Models\Discussion;
use App\Models\DiscussionReply;
use Illuminate\Http\Request;

class DiscussionReplyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($discussionId)
    {
        //get all replies
        $replies = DiscussionReply::with(['user','discussion'])->where('discussion_replies.discussion_id',$discussionId)->get();
        $discussion = Discussion::find($discussionId);

        return view("admin.discussions.replies.index", compact(
            "replies","discussion"
        ));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($discussionId, $replyId)
    {
        $reply = DiscussionReply::find($replyId);
        $discussion = Discussion::find($discussionId);
        return view("admin.discussions.replies.edit", compact(
            "reply","discussion"
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $discussionId, $replyId)
    {
        $reply = DiscussionReply::find($replyId);
        $reply->content = $request->get('content');
        $reply->save();
        alert()->success("Reply has been updated");
        return redirect('ops/discussion/'.$discussionId.'/replies');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($discussionId, $replyId)
    {
        DiscussionReply::find($replyId)->delete();
        alert()->success("Reply has been removed");
        return redirect()->back();
    }
}
