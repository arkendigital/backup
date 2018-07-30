<?php

namespace App\Http\Controllers\Admin\BoxGroups;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BoxGroup;
use App\Models\BoxItem;
use App\Models\PageWidget;
use App\Http\Requests\BoxItem as BoxItemRequest;

class BoxItemController extends Controller
{

  /**
  * Show form for creating a new item.
  *
  */
    public function create()
    {

    /**
    * Get group.
    *
    */
        $group = BoxGroup::find($_GET["group_id"]);

        /**
        * Show page.
        *
        */
        return view("admin.boxes.items.create", compact(
            "group"
        ));
    }

    /**
    * Insert a new box into a group.
    *
    * @param BoxItemRequest $request
    *
    */
    public function store(BoxItemRequest $request)
    {

    /**
    * Insert box into group.
    *
    */
        $item = BoxItem::create([
            "group_id" => request()->group_id,
            "title" => request()->title,
            "link" => request()->link
        ]);

        /**
        * Redirect back to the group.
        *
        */
        return redirect(route("box-groups.edit", $item->group));
    }

    /**
    * Display form for editing a box item.
    *
    * @param BoxItem $item
    *
    */
    public function edit(BoxItem $item)
    {
        return view("admin.boxes.items.edit", compact(
            "item"
        ));
    }

    /**
    * Update box item in database storage.
    *
    * @param BoxItem $item
    * @param BoxItemRequest $request
    *
    */
    public function update(BoxItem $item, BoxItemRequest $request)
    {

      if (request()->exists("external")) {
        $external = 1;
      } else {
        $external = 0;
      }

    /**
    * Update the box.
    *
    */
        $item->update([
            "title" => request()->title,
            "link" => request()->link,
            "external" => $external
        ]);

        /**
        * Redirect back to the group.
        *
        */
        return redirect(route("box-groups.edit", $item->group));
    }

    /**
     * Delete a box group item
     *
     * @param BoxItem $item
     *
     */
    public function destroy(BoxItem $item)
    {

        $item->delete();

        alert($item->title . " has been deleted")
            ->persistent();

        return redirect()->back();

    }
}
