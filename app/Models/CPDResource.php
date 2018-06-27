<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CPDResource extends Model
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
        "excerpt",
        "content",
        "icon_path",
        "link",
        "advert_id"
    ];

    /**
    * Indicates which table this model relates to.
    *
    * @var string
    *
    */
    protected $table = 'cpd_resources';

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
    * Get the icon attribute
    *
    * @return string
    */
    public function getIconAttribute()
    {
        $icon_path = $this->attributes["icon_path"];

        if ($icon_path == "") {
            return asset("images/defaults/avatar_default.jpg");
        }

        return env("S3_URL") . $icon_path;
    }

    /**
    * A resource can have an advert
    *
    * @return Illuminate\Database\Eloquent\Relations\HasOne
    */
    public function advert()
    {
      return $this->hasOne(Advert::class, 'id', 'advert_id');
    }
}
