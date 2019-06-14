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

class PageWidgetController extends Controller
{

  /**
  * Show form for creating a new widget.
  *
  */
    public function create()
    {

    /**
    * Get a list of pages.
    *
    */
        $pages = Page::all();

        /**
        * Display form.
        *
        */
        return view("admin.pages.widgets.create", compact(
            "pages"
        ));
    }

    /**
    * Store new widget in database storage.
    *
    * @param PageWidgetRequest $request
    *
    */
    public function store(Request $request)
    {

    /**
    * Insert widget.
    *
    */
        $widget = PageWidget::create([
            "page_id" => request()->page_id,
            "name" => request()->name,
            "slug" => request()->slug
        ]);

        /**
        * Redirect to the page the widget was assigned to.
        *
        */
        return redirect(route("pages.edit", $widget->page_id));
    }
}
