<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BoxGroup extends Model {

  use SoftDeletes;

  /**
  * The attributes that are mass assignable.
  *
  * @var array
  *
  */
  protected $fillable = [
    "name",
    "text",
    "widget_slug",
    "image_path"
  ];

  /**
  * Indicates which table this model relates to.
  *
  * @var string
  *
  */
  protected $table = 'box_groups';

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
  * A group as many items.
  *
  * @return Illuminate\Database\Eloquent\Relations\HasMany
  */
  public function items() {
    return $this->hasMany(BoxItem::class, 'group_id', 'id');
  }

  /**
  * Get items in order.
  *
  */
  public function getItems() {

    return BoxItem::where("group_id", $this->attributes["id"])
      ->orderBy("order")
      ->get();

  }

  /**
  * Get the image attribute.
  *
  * @return string
  */
  public function getImageAttribute() {

    $image_path = $this->attributes["image_path"];

    if ($image_path == "") {
      return "";
    }

    return env("S3_URL") . $image_path;

  }

}
