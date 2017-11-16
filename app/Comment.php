<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Parser\BBCodeParser as BBCode;

class Comment extends Model
{
    protected $fillable = ['commentable_id', 'commentable_type', 'user_id', 'body'];
    protected $with = ['profile'];
    
    /**
     * Get all of the owning commentable models.
     *
     * @return Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function commentable()
    {
        return $this->morphTo();
    }

    /**
     * A comment belongs to a profile
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function profile()
    {
        return $this->belongsTo(Profile::class, 'user_id', 'user_id');
    }

    /**
     * Get the Body Attribute
     *
     * @return string
     */
    public function getBodyAttribute($body)
    {
        $parser = new BBCode;
        $body = $parser->parseCaseInsensitive($body);
        $body = clean($body, 'youtube');

        return $body;
    }

    /**
     * Set the Body Attribute
     */
    public function setBodyAttribute($body)
    {
        $this->attributes['body'] = clean($body);
    }
}
