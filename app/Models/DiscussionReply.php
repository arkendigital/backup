<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DiscussionReply extends Model
{
    use SoftDeletes;

    /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
    protected $fillable = [
    "discussion_id",
    "user_id",
    "content"
  ];

    /**
    * Indicates which table this model relates to.
    *
    * @var string
    *
    */
    protected $table = 'discussion_replies';

    /**
    * Indicates if the model should be timestamped.
    *
    * @var bool
    *
    */
    public $timestamps = true;

    /**
    * The attributes that should be cast to carbon instances.
    *
    * @var array
    */
    protected $dates = ['deleted_at'];

    /**
    * A discussion has a user attached.
    *
    * @return Illuminate\Database\Eloquent\Relations\BelongsTo
    *
    */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    /**
    * A reply is attached to a discussion.
    *
    * @return Illuminate\Database\Eloquent\Relations\BelongsTo
    *
    */
    public function discussion()
    {
        return $this->belongsTo(Discussion::class, 'discussion_id', 'id');
    }
}
