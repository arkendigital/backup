<?php

namespace App;

use Cache;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Nicolaslopezj\Searchable\SearchableTrait;

class ForumThread extends Model
{
    use SoftDeletes, Sluggable, SearchableTrait;

    protected $fillable = ['title', 'user_id', 'pinned', 'status', 'forum_id', 'created_at', 'updated_at', 'legacy_id', 'last_poster_id', 'last_post_id', 'post_count', 'view_count'];

    protected $touches = ['forum'];

    /**
     * Boot the ForumThread Model.
     */
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('order', function (Builder $builder) {
            $builder->orderBy('updated_at', 'asc');
        });

        static::created(function ($thread) {
            Cache::forget('lastThread-f'.$thread->forum->id);
            Cache::forget('lastPoster-f'.$thread->forum->id);

            Cache::forget('lastPoster-t'.$thread->id);
            Cache::forget('lastPost-t'.$thread->id);
   
            $thread->forum->update([
                'last_thread_id' => $thread->id
            ]);
        });
    }

    /**
     * Searchable rules.
     *
     * @var array
     */
    protected $searchable = [
        /*
         * Columns and their priority in search results.
         * Columns with higher values are more important.
         * Columns with equal values have equal importance.
         *
         * @var array
         */
        'columns' => [
            'forum_posts.content' => 10,
            'forum_threads.title' => 5,
            'forums.name' => 2,
        ],
        'joins' => [
            'forum_posts' => ['forum_threads.id', 'forum_posts.thread_id'],
            'forums' => ['forum_threads.forum_id', 'forums.id'],
        ],
    ];

    /**
     * Fetch the URL to the current thread.
     *
     * @return string
     */
    public function url()
    {
        return "/forums/{$this->forum->slug}/{$this->slug}";
    }

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title',
            ],
        ];
    }

    /**
     * A thread belongs to a forum
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function forum()
    {
        return $this->belongsTo(Forum::class);
    }

    /**
     * A thread has many posts
     *
     * @return Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function posts()
    {
        return $this->hasMany(ForumPost::class, 'thread_id', 'id');
    }

    /**
     * A thread belongs to a user
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * A thread belongs to a user
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function profile()
    {
        return $this->belongsTo(Profile::class, 'user_id', 'user_id');
    }

    /**
     * A thread has many subscriptions
     *
     * @return Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function subscriptions()
    {
        return $this->hasMany(ForumThreadSubscription::class, 'thread_id');
    }

    /**
     * A thread can be subscribed to
     *
     * @param int|null $userId
     * @return Model
     */
    public function subscribe($userId = null)
    {
        $this->subscriptions()->create([
            'user_id' => $userId ?: auth()->id()
        ]);
        return $this;
    }

    /**
     * A thread can be unsubscribed from
     *
     * @param int|null $userId
     * @return Model
     */
    public function unsubscribe($userId = null)
    {
        $this->subscriptions()->where('user_id', $userId ?: auth()->id())->delete();
        return $this;
    }

    /**
     * Check if the user is subscribed
     *
     * @return Model
     */
    public function getIsSubscribedToAttribute()
    {
        return $this->subscriptions()->where(['user_id' => auth()->id()])->exists();
    }

    /**
     * Get the last post in a thread
     *
     * return App\ForumPost
     */
    public function getlastPostAttribute()
    {
        if ($this->last_post_id) {
            $sixMonths = Carbon::now()->addMonths(6);
            $lastPost = Cache::remember('lastPost-t'.$this->id, $sixMonths, function () {
                return ForumPost::find($this->last_post_id);
            });
            return $lastPost;
        }
    }

    /**
     * Get the last poster in a thread
     *
     * @return App\Profile
     */
    public function getlastPosterAttribute()
    {
        if ($this->last_poster_id) {
            $sixMonths = Carbon::now()->addMonths(6);
            $lastPoster = Cache::remember('lastPoster-t'.$this->id, $sixMonths, function () {
                return Profile::where('user_id', $this->last_poster_id)->first();
            });
            return $lastPoster;
        }
    }

    /**
     * Get the route key name
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

    /**
     * Get the first post in a thread
     *
     * @return Model
     */
    public function firstPost()
    {
        return $this->posts()->first();
    }
}
