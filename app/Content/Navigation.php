<?php
namespace App\Content;

use Carbon\Carbon;
use Illuminate\Support\Facades\App;
use App\Models\SectionSidebar;
use Cache;

class Navigation
{
    public function mainMenu()
    {
        // return Cache::remember('navigation_menu', 120, function () {
        $menu = collect();

        foreach ($this->menus() as $item) {
            $menu->put($item->slug, $this->buildSubNav($item->slug));
        }

        return $menu;
        // });
    }

    public function menus()
    {
        return SectionSidebar::with('items', 'items.page')->get();
    }

    public function subItemBySlug($slug)
    {
        return SectionSidebar::with('items', 'items.page')->where('slug', $slug)->first();
    }

    public function buildSubNav($slug)
    {
        $items = collect();

        $sidebar = $this->subItemBySlug($slug);

        foreach ($sidebar->items as $item) {
            $sub_item = collect();
            $sub_item->sidebar_item_id = $item->id;
            $sub_item->order = $item->order;

            if ($item->page_id == 0) {
                $sub_item->text = $item->link_text;
                $sub_item->url = $item->url;
            } else {
                $sub_item->text = $item->page->name;

                if (substr($item->page->slug, 0, 1) != '/') {
                    $sub_item->url = '/' . $item->page->slug;
                } else {
                    $sub_item->url = $item->page->slug;
                }
            }

            $items->push($sub_item);
        }

        return $items;
    }
}
