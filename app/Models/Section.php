<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Section extends Model
{
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
        "image_path",
        "thumbnail_path",
        "sidebar_id",
        "order"
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
    public function pages()
    {
        return $this->hasMany(Page::class, 'section_id', 'id');
    }

    /**
    * A section can have many custom fields.
    *
    * @return Illuminate\Database\Eloquent\Relations\HasMany
    */
    public function fields()
    {
        return $this->hasMany(SectionField::class, 'section_id', 'id');
    }

    /**
    * A section only has one sidebar.
    *
    * @return Illuminate\Database\Eloquent\Relations\HasOne
    */
    public function sidebar()
    {
        return $this->hasOne(SectionSidebar::class, 'id', 'sidebar_id');
    }

    /**
    * Get the fully qualified path of the image.
    *
    */
    public function getImageAttribute()
    {
        $image_path = $this->attributes["image_path"];

        if ($image_path == "") {
            return "/images/placeholder/article.png";
        }

        return env("S3_URL") . $image_path;
    }

    /**
    * Get the fully qualified path of the thumbnail.
    *
    */
    public function getThumbnailAttribute()
    {
        $thumbnail_path = $this->attributes["thumbnail_path"];

        if ($thumbnail_path == "") {
            return "";
        }

        return env("S3_URL") . $thumbnail_path;
    }

    public function getField($section, $key)
    {
        $new_section = Section::where("slug", $section)
             ->first();

        if ($new_section !== null) {
            foreach ($new_section->fields as $field) {
                if ($key == $field->key) {
                    return $field->value;
                }
            }
        }

        return '';
    }
}
