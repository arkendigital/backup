<?php

namespace App\Http\Controllers\Admin\BoxGroups;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\BoxGroup;
use App\Models\BoxItem;

class BoxItemOrderController extends Controller {

  /**
  * Show page for updating the ordering of items.
  *
  * @param BoxGroup $group
  *
  */
  public function index(BoxGroup $group) {

    return view("admin.boxes.items.order", compact(
      "group"
    ));

  }

  public function update(Request $request) {

    foreach(request()->order as $iteration => $item_id) {
      $order = ($iteration + 1);
      $item = BoxItem::find($item_id);
      $item->update(["order" => $order]);
    }

    return redirect()->back();

  }

}
