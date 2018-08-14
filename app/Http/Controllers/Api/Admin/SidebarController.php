<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\SectionSidebar;
use App\Models\SectionSidebarItem;

class SidebarController extends Controller
{

  /**
  * Add a new page to the sidebar.
  *
  * @param Request $request
  */
    public function addPage(Request $request)
    {
        $item = SectionSidebarItem::create([
            "sidebar_id" => $request->sidebar_id,
            "page_id" => $request->page_id
        ]);
    }

    /**
    * Remove an item from the sidebar.
    *
    * @param Request $request
    *
    */
    public function removeItem(Request $request)
    {
        SectionSidebarItem::where("id", request()->sidebar_item_id)->delete();
    }

    /**
    * Add a new link to the sidebar.
    *
    * @param Request $request
    *
    */
    public function addLink(Request $request)
    {
        $item = SectionSidebarItem::create([
            "sidebar_id" => $request->sidebar_id,
            "link_text" => $request->link_text,
            "url" => $request->link_url
        ]);
    }
}
