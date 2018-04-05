<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DiscussionCategory extends Model
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
      "description",
      "parent_id",
      "position",
      "icon_id"
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
    * A category has an icon.
    *
    * @return \Illuminate\Database\Eloquent\Relations\HasOne
    */
    public function icon()
    {
        return $this->hasOne(DiscussionIcon::class, 'id', 'icon_id');
    }

    /**
    * Get the fully qualified path of the discussion category.
    *
    */
    public function getGetURLAttribute()
    {
        return env("APP_URL")."/discussion/".$this->slug;
    }
}
