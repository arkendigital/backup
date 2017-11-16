<?php

namespace App\Http\Controllers\Article;

use App\Article;
use App\Comment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CommentsController extends Controller
{
    /**
     * Store a comment in the database
     *
     * @return Illuminate\Http\Response
     */
    public function store(Article $article, Request $request)
    {
        $article->comments()->create([
            'body' => $request->body,
            'user_id' => auth()->user()->id
        ]);

        // event(new ArticleCommentCreated(auth()->user(), $file));

        alert()->success('Comment Created');
        return back();
    }

    /**
     * Show the edit comment form
     *
     * @return Illuminate\View\View
     */
    public function edit(Article $article, Comment $comment)
    {
        return view('articles.comments.edit', compact(['article', 'comment']));
    }

    /**
     * Update the comment in the database
     *
     * @return Illuminate\Http\Response
     */
    public function update(Article $article, Comment $comment, Request $request)
    {
        $comment->update(['body' => $request->body]);
        alert()->success('Comment Updated');
        return redirect()->route('showArticle', [$article->game, $article]);
    }

    /**
     * Delete a comment
     *
     * @return Illuminate\Http\Response
     */
    public function destroy(Article $article, Comment $comment)
    {
        if ($comment->user_id == auth()->user()->id || auth()->user()->isStaff()) {
            $comment->delete();
            alert()->success('Comment Deleted');
            return back();
        }
    }
}
