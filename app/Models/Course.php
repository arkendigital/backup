<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Cviebrock\EloquentSluggable\Sluggable;

class Course extends Model {

  use SoftDeletes, Sluggable;

  /**
  * The attributes that are mass assignable.
  *
  * @var array
  *
  */
  protected $fillable = [
    "name",
    "slug",
    "description"
  ];

  /**
  * Return the sluggable configuration array for this model.
  *
  * @return array
  */
  public function sluggable() {
    return [
      "slug" => [
        "source" => "name",
      ],
    ];
  }

  /**
  * Get the route key name
  */
  public function getRouteKeyName() {
    return "slug";
  }

  /**
  * Indicates which table this model relates to.
  *
  * @var string
  *
  */
  protected $table = 'courses';

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
  *
  */
  protected $dates = ['deleted_at'];

}
