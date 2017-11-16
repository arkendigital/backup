<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReportTopic extends Model
{
    protected $fillable = ['title', 'content_id', 'content_type', 'author_id', 'owner_id', 'status'];

    /**
     * Get the content attribute
     *
     * @return App\ForumPost
     */
    public function getContent()
    {
        $type = $this->content_type;

        switch ($type) {
            case 'post':
                return ForumPost::where('id', $this->content_id)->first();
                break;
        }
    }

    /**
     * A report topic has many report posts
     *
     * @return Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function posts()
    {
        return $this->hasMany(ReportPost::class, 'topic_id', 'id');
    }

    /**
     * A report topic belongs to a user
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function owner()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * A report topic belongs to a user
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function author()
    {
        return $this->belongsTo(User::class);
    }
}
