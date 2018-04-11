<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PageWidget extends Model
{

  /**
  * The attributes that are mass assignable.
  *
  * @var array
  */
    protected $fillable = [
        "page_id",
        "is_visible",
        "widget_id",
        "name",
        "slug",
        "order"
    ];

    /**
    * The attributes that should be cast to carbon instances.
    *
    * @var array
    */
    protected $table = 'page_widgets';

    /**
    * Indicates if the model should be timestamped.
    *
    * @var bool
    *
    */
    public $timestamps = true;

    /**
    * A widget is attached to a page.
    *
    * @return Illuminate\Database\Eloquent\Relations\HasOne
    */
    public function page()
    {
        return $this->hasOne(Page::class, 'id', 'page_id');
    }

    /**
    * A page widget is attached to a widget.
    *
    * @return Illuminate\Database\Eloquent\Relations\HasOne
    */
    public function widget()
    {
        return $this->hasOne(Widget::class, 'id', 'widget_id');
    }

    /**
    * Return a box group.
    *
    */
    public function getBoxGroup($slug)
    {
        return BoxGroup::where("widget_slug", $slug)
            ->first();
    }
}
