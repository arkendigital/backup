<?php

namespace App;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use App\Parser\BBCodeParser as BBCode;

class Article extends Model
{
    use Sluggable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'slug',
        'body',
        'user_id',
        'category_id',
        'image',
        'game_id',
        'fn_id',
        'legacy_news',
        'created_at',
        'status'
    ];

    // protected $with = ['profile'];

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
                'source' => 'title',
            ],
        ];
    }

    /**
     * Get the route key name for this model
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

    /**
     * An article belongs to a User
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * An article belongs to a Profile
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function profile()
    {
        return $this->belongsTo(Profile::class, 'user_id', 'user_id');
    }

    /**
     * Get all of the files' comments.
     */
    public function comments()
    {
        return $this->morphMany('App\Comment', 'commentable');
    }

    /**
     * Get the Body Attribute
     *
     * @return string
     */
    // public function getBodyAttribute($body)
    // {
    //     $parser = new BBCode;
    //     $body = $parser->parseCaseInsensitive($body);
    //     $body = clean($body, 'youtube');

    //     return $body;
    // }

    /**
     * Set the Body Attribute
     *
     * @return void
     */
    public function setBodyAttribute($body)
    {
        $this->attributes['body'] = clean($body);
    }

    public function getImageAttribute($value)
    {
        $image_path = $value;

        if ($image_path == "") {
            return "/images/placeholder/article.png";
        }

        return $image_path;
    }
}
