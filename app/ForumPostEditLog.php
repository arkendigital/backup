<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ForumPostEditLog extends Model
{
    use SoftDeletes;

    protected $fillable = ['content', 'user_id'];

    /**
     * An edit log belongs to a Post
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function post()
    {
        return $this->belongsTo(ForumPost::class);
    }

    /**
     * An edit log belongs to a User
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
