<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CPDPublication extends Model
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
    "link"
  ];

    /**
    * Indicates which table this model relates to.
    *
    * @var string
    *
    */
    protected $table = 'cpd_publications';

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
    *
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
    * Get the route key name.
    *
    */
    public function getRouteKeyName()
    {
        return 'slug';
    }
}
