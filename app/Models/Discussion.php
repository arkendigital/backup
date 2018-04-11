<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\User;
use App\Models\DiscussionReply;

class Discussion extends Model
{
    use SoftDeletes, Sluggable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        "name",
        "slug",
        "subject",
        "content",
        "excerpt",
        "user_id",
        "category_id",
        "image_path"
    ];

    /**
     * The attributes that should be cast to carbon instances.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

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
     * Get the route key name
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

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
    * A discussion belongs to a category.
    *
    * @return Illuminate\Database\Eloquent\Relations\BelongsTo
    *
    */
    public function category()
    {
        return $this->belongsTo(DiscussionCategory::class, 'category_id', 'id');
    }

    /**
    * A discussion can have many replies.
    *
    * @return Illuminate\Database\Eloquent\Relations\HasMany
    *
    */
    public function replies()
    {
        return $this->hasMany('App\Models\DiscussionReply', 'discussion_id', 'id');
    }

    /**
    * Get the total amount of replies for the discussion.
    *
    */
    public function getReplyCountAttribute()
    {
        /**
        * Set discussion id.
        */
        $discussion_id = $this->attributes["id"];

        /**
        * Get amount of replies for this discussion.
        */
        $count = DiscussionReply::where("discussion_id", $discussion_id)
            ->count();

        /**
        * Return the count and make sure it is minimum 2 digits.
        *
        */
        if ($count < 10) {
            return "0".$count;
        } else {
            return $count;
        }
    }

    /**
    * Check if a user is allowed edit the discussion.
    */
    public function canEdit()
    {
        if (auth()->check() && auth()->user()->id == $this->id) {
            return true;
        } elseif (auth()->check() && auth()->user()->hasRole("Super Administrator|Administrator")) {
            return true;
        } else {
            return false;
        }
    }

    /**
    * Get full URL of image.
    *
    */
    public function getImageAttribute()
    {
        if ($this->image_path != "") {
            return env("S3_URL") . $this->image_path;
        } else {
            return asset("/images/temp/homepage-discussion-1-bg.png");
        }
    }
}
