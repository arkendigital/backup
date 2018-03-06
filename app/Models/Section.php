<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Section extends Model {

  use SoftDeletes;

  /**
  * The attributes that are mass assignable.
  *
  * @var array
  *
  */
  protected $fillable = [
    "name",
    "color",
    "slug",
    "image_path"
  ];

  /**
  * Indicates which table this model relates to.
  *
  * @var string
  *
  */
  protected $table = 'sections';

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
  * CUSTOMIZATION
  */

  /**
  * A section can have many pages.
  *
  * @return Illuminate\Database\Eloquent\Relations\HasMany
  */
  public function pages() {
    return $this->hasMany(Page::class, 'section_id', 'id');
  }

  /**
  * A section can have many custom fields.
  *
  * @return Illuminate\Database\Eloquent\Relations\HasMany
  */
  public function fields() {
    return $this->hasMany(SectionField::class, 'section_id', 'id');
  }

  /**
  * Get the fully qualified path of the image.
  *
  */
  public function getImageAttribute() {

    $image_path = $this->attributes["image_path"];

    if ($image_path == "") {
      return "/images/placeholder/article.png";
    }

    return env("S3_URL") . $image_path;

  }

  public function ScopeGetField($query, $section, $key) {

    $new_section = Section::where("slug", $section)
      ->first();

    foreach($new_section->fields as $field) {
      if ($key == $field->key) {
        return $field->value;
      }
    }

    return '';

  }


}
