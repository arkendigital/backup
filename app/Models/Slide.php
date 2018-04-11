<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Slide extends Model
{

  /**
  * The attributes that are mass assignable.
  *
  * @var array
  *
  */
    protected $fillable = [
        "slug",
        "title",
        "text",
        "order",
        "image_path"
    ];

    /**
    * Indicates which table this model relates to.
    *
    * @var string
    *
    */
    protected $table = 'slides';

    /**
    * Indicates if the model should be timestamped.
    *
    * @var bool
    *
    */
    public $timestamps = false;

    /**
    * Get all slides with a particular slug.
    *
    */
    public function getSlides($slug)
    {
        return Slide::where("slug", $slug)
            ->get();
    }

    /**
    * Get the image attribute.
    *
    * @return string
    */
    public function getImageAttribute()
    {
        $image_path = $this->attributes["image_path"];

        if ($image_path == "") {
            return "";
        }

        return env("S3_URL") . $image_path;
    }
}
