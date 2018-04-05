<?php

namespace App\Http\Controllers\Admin\Sidebars;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Section;
use App\Models\SectionSidebar;
use App\Models\SectionSidebarItem;

class SidebarOrderController extends Controller
{

  /**
  * Show page for updating the ordering of sidebar links.
  *
  * @param SectionSidebar $sidebar
  *
  */
    public function index(SectionSidebar $sidebar)
    {
        return view("admin.sidebars.order", compact(
      "sidebar"
    ));
    }

    public function update(Request $request)
    {
        foreach (request()->order as $iteration => $sidebar_item_id) {
            $order = ($iteration + 1);
            $item = SectionSidebarItem::find($sidebar_item_id);
            $item->update(["order" => $order]);
        }

        return redirect()->back();
    }
}
