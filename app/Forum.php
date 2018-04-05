<?php

namespace App;

use Carbon\Carbon;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Cache;

class Forum extends Model
{
    use SoftDeletes, Sluggable;

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'name',
            ],
        ];
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description', 'slug', 'parent', 'position', 'category_id', 'icon', 'roles', 'legacy_id', 'last_thread_id', 'last_poster_id', 'last_post_id', 'updated_at'
    ];

    /**
     * A Forum belongs to a Category
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(ForumCategory::class);
    }

    /**
     * A forum can have many children
     *
     * @return Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function children()
    {
        return $this->hasMany(Forum::class, 'parent');
    }

    /**
     * A Forum has many Threads
     *
     * @return Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function threads()
    {
        return $this->hasMany(ForumThread::class);
    }

    /**
     * Get the last post in a thread
     *
     * return App\ForumPost
     */
    public function getlastThreadAttribute()
    {
        if ($this->last_thread_id) {
            $sixMonths = Carbon::now()->addMonths(6);
            $lastThread = Cache::remember('lastThread-f'.$this->id, $sixMonths, function () {
                return ForumThread::find($this->last_thread_id);
            });
            return $lastThread;
        }
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
            $lastPost = Cache::remember('lastPost-f'.$this->id, $sixMonths, function () {
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
            $lastPoster = Cache::remember('lastPoster-f'.$this->id, $sixMonths, function () {
                return Profile::where('user_id', $this->last_poster_id)->first();
            });
            return $lastPoster;
        }
    }

    /**
     * Get the route key name
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

    /**
     * Set the roles attribute
     *
     * @return void
     */
    public function setRolesAttribute($roles)
    {
        $this->attributes['roles'] = json_encode($roles);
    }

    /**
     * Get the roles attribute
     *
     * @return array
     */
    public function getRolesAttribute($roles)
    {
        return json_decode($roles, true);
    }
}
