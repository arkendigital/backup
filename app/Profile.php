<?php

namespace App;

use Cache;
use Carbon\Carbon;
use App\Parser\BBCodeParser as BBCode;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use JamesMills\Watchable\Traits\Watchable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Profile extends Model
{
    use SoftDeletes, Sluggable, Watchable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'slug',
        'display_name',
        'user_title',
        'location',
        'gender',
        'date_birth',
        'avatar',
        'signature',
        'post_count',
        'about',
        'social_networks'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'api_token',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
        'date_birth',
    ];

    protected $appends = ['avatar', 'cover'];

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
     * A Profile belongs to a User
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the avatar attribute
     *
     * @return string
     */
    public function getAvatarAttribute()
    {
        if (!$this->avatar_path) {
            return asset('images/defaults/avatar_default.jpg');
        }
        return asset('storage/'. $this->avatar_path);
    }

    /**
     * Get the Cover Photo Attribute
     *
     * @return string
     */
    public function getCoverAttribute()
    {
        if (!$this->cover_photo_path) {
            return asset('images/defaults/profile_default.jpg');
        }
        return asset('storage/'. $this->cover_photo_path);
    }

    /**
     * Get the About Attribute
     *
     * @return string
     */
    public function getAboutAttribute($about)
    {
        $parser = new BBCode;
        $about = $parser->parseCaseInsensitive($about);
        $about = clean($about, 'youtube');

        return $about;
    }

    /**
     * Set the About Attribute
     *
     * @return void
     */
    public function setAboutAttribute($about)
    {
        $this->attributes['about'] = clean($about);
    }

    /**
     * Get the Signature Attribute
     *
     * @return string
     */
    public function getSignatureAttribute($signature)
    {
        $parser = new BBCode;
        $signature = $parser->parseCaseInsensitive($signature);
        $signature = clean($signature, 'youtube');

        return $signature;
    }

    /**
     * Set the Signature Attribute
     *
     * @return void
     */
    public function setSignatureAttribute($signature)
    {
        $this->attributes['signature'] = clean($signature);
    }

    /**
     * Set the Social Networks Attribute
     *
     * @return void
     */
    public function setSocialNetworksAttribute($socialNetworks)
    {
        $this->attributes['social_networks'] = serialize($socialNetworks);
    }

    /**
     * Get the Social Networks Attribute
     *
     * @return array
     */
    public function getSocialNetworksAttribute($socialNetworks)
    {
        return unserialize($socialNetworks);
    }
}
