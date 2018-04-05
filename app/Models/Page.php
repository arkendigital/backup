<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\PageField;
use App\Models\PageAdvert;
use App\Models\PageWidget;
use App\Models\Section;

class Page extends Model
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
    * Get page information.
    *
    */
    public static function getPage($slug)
    {
        $page = Page::where("slug", $slug)
      ->first();

        if (null === $page) {
            $return = new \stdClass();
            $return->meta_title = "";
            $return->meta_description = "";

            return $return;
        } else {
            return $page;
        }
    }





    /**
    * A page can have many custom fields.
    *
    * @return Illuminate\Database\Eloquent\Relations\HasMany
    */
    public function fields()
    {
        return $this->hasMany(PageField::class, 'page_id', 'id');
    }

    /**
    * A page has one section attached to it.
    *
    * @return Illuminate\Database\Eloquent\Relations\HasOne
    */
    public function section()
    {
        return $this->hasOne(Section::class, 'id', 'section_id');
    }

    /**
    * A page can have many adverts.
    *
    * @return Illuminate\Database\Eloquent\Relations\HasMany
    */
    public function adverts()
    {
        return $this->hasMany(PageAdvert::class, 'page_id', 'id');
    }

    /**
    * A page can have many widgets.
    *
    * @return Illuminate\Database\Eloquent\Relations\HasMany
    */
    public function widgets()
    {
        return $this->hasMany(PageWidget::class, 'page_id', 'id');
    }

    public function ScopeGetField($query, $key, $type = "")
    {
        foreach ($this->fields as $field) {
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


    public function ScopeGetAdvert($query, $slug)
    {
        $page_advert = PageAdvert::where("page_id", $this->id)
      ->where("slug", $slug)
      ->first();

        $advert = Advert::find($page_advert->advert_id);

        return $advert;
    }

    /**
    * Check to see if a widget on a specific page is visible
    *
    */
    public function widgetIsVisible($slug = "")
    {
        $widget = PageWidget::where("slug", $slug)
      ->first();

        if ($widget !== null) {
            if ($widget->is_visible) {
                return true;
            }
        }

        return false;
    }

    /**
    * Get widgets to display on a page.
    *
    */
    public function getWidgets()
    {
        return PageWidget::where("page_id", $this->attributes["id"])
      ->orderBy("order", "ASC")
      ->get();
    }
}
