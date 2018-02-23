<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\PageField;
use App\Models\Section;

class Page extends Model {

  use SoftDeletes, Sluggable;

  /**
  * The attributes that are mass assignable.
  *
  * @var array
  */
  protected $fillable = [
    "name",
    "slug",
    "section_id",
    "discussion_category_id",
    "meta_title",
    "meta_description"
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
    public function sluggable() {
      return [
        'slug' => [
          'source' => 'name',
        ],
      ];
    }

    /**
     * Get the route key name
     */
    public function getRouteKeyName() {
      return 'slug';
    }

    /**
    * A page can have many custom fields.
    *
    * @return Illuminate\Database\Eloquent\Relations\HasMany
    */
    public function fields() {
      return $this->hasMany(PageField::class, 'page_id', 'id');
    }

    /**
    * A page has one section attached to it.
    *
    * @return Illuminate\Database\Eloquent\Relations\HasOne
    */
    public function section() {
      return $this->hasOne(Section::class, 'id', 'section_id');
    }

    public function ScopeGetField($query, $key, $type = "") {
      foreach($this->fields as $field) {
        if ($field->key == $key) {
          $return = $field->value;

          if ($type == "image") {
            return env("S3_URL") . str_replace("-thumb", "", $field->value);
          }

          return $return;
        }
      }
      return '';
    }

}
