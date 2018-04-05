<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SectionSidebar extends Model
{

  /**
  * The attributes that are mass assignable.
  *
  * @var array
  *
  */
    protected $fillable = [
    "name",
    "slug"
  ];

    /**
    * Indicates which table this model relates to.
    *
    * @var string
    *
    */
    protected $table = 'sections_sidebars';

    /**
    * Indicates if the model should be timestamped.
    *
    * @var bool
    *
    */
    public $timestamps = true;

    /**
    * Get the pages linked to this sidebar.
    *
    */
    public function getPages()
    {
        return SectionSidebarItem::where("sidebar_id", $this->attributes["id"])
      ->where("page_id", "!=", 0)
      ->get();
    }

    /**
    * Get the links linked to this sidebar.
    *
    */
    public function getLinks()
    {
        return SectionSidebarItem::where("sidebar_id", $this->attributes["id"])
      ->where("page_id", 0)
      ->get();
    }

    /**
    * Get a combination of pages and links
    *
    */
    public function getItems($slug = "")
    {
        if ($slug == "") {
            $all = SectionSidebarItem::where("sidebar_id", $this->attributes["id"])
        ->orderBy("order", "ASC")
        ->get();
        } else {
            $sidebar = SectionSidebar::where("slug", $slug)
        ->first();

            $all = SectionSidebarItem::where("sidebar_id", $sidebar->id)
        ->orderBy("order", "ASC")
        ->get();
        }

        $items = collect();

        foreach ($all as $item) {
            $new = collect();
            $new->sidebar_item_id = $item->id;
            $new->order = $item->order;

            if ($item->page_id == 0) {
                $new->text = $item->link_text;
                $new->url = $item->url;
            } else {
                $new->text = $item->page->name;

                if (substr($item->page->slug, 0, 1) != "/") {
                    $new->url = "/".$item->page->slug;
                } else {
                    $new->url = $item->page->slug;
                }
            }

            $items->push($new);
        }

        return $items;
    }
}
