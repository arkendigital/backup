<?php

namespace App\Http\Controllers\Admin\Pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

/**
* Load models.
*
*/
use App\Models\Page;
use App\Models\PageWidget;

class PageWidgetOrderController extends Controller {

  /**
  * Display page for changing the order.
  *
  */
  public function index($page_id) {

    /**
    * Get page.
    *
    */
    $page = Page::find($page_id);

    /**
    * Show page.
    *
    */
    return view("admin.pages.widgets.order", compact(
      "page"
    ));

  }

  public function update(Request $request) {

    foreach(request()->order as $iteration => $widget_id) {
      $order = ($iteration + 1);
      $item = PageWidget::find($widget_id);
      $item->update(["order" => $order]);
    }

    return redirect()->back();

  }

}
