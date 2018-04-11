<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SectionSidebarItem extends Model
{

    /**
     * The attributes that are mass assignable.
    *
    * @var array
    *
    */
    protected $fillable = [
        "sidebar_id",
        "page_id",
        "link_text",
        "url",
        "order"
    ];

    /**
    * Indicates which table this model relates to.
    *
    * @var string
    *
    */
    protected $table = 'sections_sidebars_items';

    /**
    * Indicates if the model should be timestamped.
    *
    * @var bool
    *
    */
    public $timestamps = true;

    /**
    * A sidebar item has one page.
    *
    * @return \Illuminate\Database\Eloquent\Relations\HasOne
    */
    public function page()
    {
        return $this->hasOne(Page::class, 'id', 'page_id');
    }
}
