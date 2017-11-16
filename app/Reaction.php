<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reaction extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'post_id', 'reaction',
    ];

    /**
     * A Reaction belongs to a Post
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function post()
    {
        return $this->belongsTo('App\ForumPost');
    }

    /**
     * Count the reactions associated with this post
     *
     * @return App\Reaction
     */
    public function countReactions($post_id, $reaction)
    {
        return $this->where(['post_id' => $post_id, 'reaction' => $reaction])->count();
    }

    /**
     * Has a user reacted to this post?
     *
     * @return boolean
     */
    public function hasReacted($post)
    {
        return $this->where(['post_id' => $post->id, 'user_id' => Auth::user()->id])->first();
    }
}
