<?php

namespace App;

use Cache;
use Vamsi\HTMLToBBCode\HtmlConverter;
use App\Parser\BBCodeParser as BBCode;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;

class ForumPost extends Model
{
    use SoftDeletes;

    protected $touches = ['thread'];

    protected $fillable = ['content', 'user_id', 'thread_id', 'created_at', 'updated_at', 'legacy_id'];

    protected $with = ['profile'];
    
    /**
     * Boot the ForumPost Model.
     */
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('order', function (Builder $builder) {
            $builder->orderBy('created_at', 'asc');
        });

        static::created(function ($post) {
            Cache::forget('lastPost-'.$post->thread->forum->id);
            Cache::forget('lastPoster-t'.$post->thread->id);
            Cache::forget('lastPost-t'.$post->thread->id);
            Cache::forget('lastPoster-f'.$post->thread->forum->id);

            $post->thread->update([
                'last_post_id' => $post->id,
                'last_poster_id' => $post->user->id
            ]);

            $post->thread->forum->update([
                'last_post_id' => $post->id,
                'last_poster_id' => $post->user->id,
                'last_thread_id' => $post->thread->id
            ]);
        });
    }

    /**
     * Get the Content Attribute
     *
     * @return string
     */
    public function getContentAttribute($content)
    {
        $parser = new BBCode;
        $content = $parser->parseCaseInsensitive($content);
        $content = clean($content, 'youtube');

        return $content;
    }

    /**
     * Set the content attribute
     *
     * @return void
     */
    public function setContentAttribute($content)
    {
        $this->attributes['content'] = clean($content);
    }

    /**
     * A Post belongs to a Thread
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function thread()
    {
        return $this->belongsTo(ForumThread::class, 'thread_id', 'id');
    }

    /**
     * A Post belongs to a User
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * A Post belongs to a Profile
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function profile()
    {
        return $this->belongsTo(Profile::class, 'user_id', 'user_id');
    }

    /**
     * A Post has many reactions
     *
     * @return Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function reactions()
    {
        return $this->hasMany(Reaction::class, 'post_id');
    }

    /**
     * A post has many edit logs
     *
     * @return Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function editLog()
    {
        return $this->hasMany(ForumPostEditLog::class, 'post_id', 'id');
    }

    /**
     * Has a post been edited?
     *
     * @return boolean
     */
    public function hasBeenEdited()
    {
        if ($this->editLog->count() > 0) {
            return true;
        }

        return false;
    }

    /**
     * Who was the post last edited by?
     *
     * @return App\User
     */
    public function lastEditedBy()
    {
        if ($this->hasBeenEdited()) {
            return $this->editLog->last()->user;
        }
    }
}
