<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Cviebrock\EloquentSluggable\Sluggable;

class Society extends Model {

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
    "postcode",
    "latitude",
    "longitude",
    "city",
    "email",
    "link",
    "image_path",
    "logo_path",
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
  protected $table = 'societies';

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

  /**
  * Get full URL of logo.
  *
  */
  public function getLogoAttribute() {

    if ($this->logo_path != "") {

      return env("S3_URL") . $this->logo_path;

    }

    else {

      return "";

    }

  }

  /**
  * Get full URL of image.
  *
  */
  public function getImageAttribute() {

    if ($this->image_path != "") {

      return env("S3_URL") . $this->image_path;

    }

    else {

      return "";

    }

  }

}
