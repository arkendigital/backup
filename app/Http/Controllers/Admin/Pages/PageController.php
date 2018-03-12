<?php

namespace App\Http\Controllers\Admin\Pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Page;
use App\Models\PageField;
use App\Models\PageAdvert;
use App\Models\PageWidget;
use App\Models\Section;
use App\Models\DiscussionCategory;
use App\Models\Widget;

class PageController extends Controller {

  /**
  * Display a list of pages.
  */
  public function index() {

    /**
    * Get sections.
    */
    $sections = Section::all();

    /**
    * Get pages not assigned a section.
    */
    $misc_pages = Page::where("section_id", NULL)
      ->get();

    /**
    * Display results.
    */
    return view("admin.pages.index", compact(
      "pages",
      "misc_pages",
      "sections"
    ));

  }

  /**
  * Show form for creating a new page.
  */
  public function create() {

    /**
    * Get list of sections.
    */
    $sections = Section::all();

    /**
    * Display form.
    */
    return view("admin.pages.create", compact(
      "sections"
    ));

  }

  /**
  * Store a new page in database storage.
  *
  * @param Request $request
  *
  */
  public function store(Request $request) {

    /**
    * Store page in storage.
    */
    $page = Page::create([
      "name" => request()->name,
      "section_id" => request()->section_id,
      "meta_title" => request()->meta_title,
      "meta_description" => request()->meta_description
    ]);

    /**
    * Redirect to page edit form.
    */
    return redirect("/ops/pages/".$page->id."/edit");

  }

  /**
  * Show page edit form / page.
  *
  * @param int $page_id
  *
  */
  public function edit($page_id) {

    /**
    * Get page.
    *
    */
    $page = Page::find($page_id);

    /**
    * Get list of sections.
    */
    $sections = Section::all();

    /**
    * Get list of discussion categories.
    */
    $categories = DiscussionCategory::all();

    /**
    * Display form.
    */
    return view("admin.pages.edit", compact(
      "sections",
      "categories",
      "page"
    ));

  }

  /**
  * Update page in database storage.
  *
  * @param int $page_id
  * @param Request $request
  *
  */
  public function update($page_id, Request $request) {

    /**
    * Get page.
    *
    */
    $page = Page::find($page_id);

    /**
    * Store page in storage.
    */
    $page->update([
      "name" => request()->name,
      "section_id" => request()->section_id,
      "discussion_category_id" => request()->discussion_category_id,
      "meta_title" => request()->meta_title,
      "meta_description" => request()->meta_description
    ]);

    /**
    * If the slug has been set, update it.
    *
    */
    if (isset(request()->slug) && request()->slug != "") {
      $page->update([
        "slug" => request()->slug
      ]);
    }

    /**
    * Save custom fields.
    */
    if(!empty(request()->field)) {
      foreach(request()->field as $key => $field) {
        $page_field = PageField::where("key", $key)
          ->where("page_id", $page->id)
          ->first();

        $page_field->update([
          "value" => $field
        ]);
      }
    }

    /**
    * Save adverts.
    */
    if(!empty(request()->adverts)) {
      foreach(request()->adverts as $page_advert_id => $advert_id) {

        $page_advert = PageAdvert::find($page_advert_id);

        $page_advert->update([
          "advert_id" => $advert_id
        ]);

      }
    }

    /**
    * Save widget preferences.
    *
    */
    if (!empty(request()->widgets)) {
      $page_widgets = PageWidget::where("page_id", $page->id)
        ->get();

      foreach(request()->widgets as $widget_id => $visible) {

        foreach($page_widgets as $widget) {
          if (in_array($widget->id, request()->widgets)) {
            $widget->update([
              "is_visible" => 1
            ]);
          } else {
            $widget->update([
              "is_visible" => 0
            ]);
          }
        }

      }
    } else {

      PageWidget::where("page_id", $page->id)
        ->update(["is_visible" => 0]);

    }

    /**
    * Redirect to page edit form.
    */
    return redirect("/ops/pages/".$page->id."/edit");

  }

  /**
  * Display page for adding a new widget to the page.
  *
  * @param int $id
  *
  */
  public function addWidget($id) {

    /**
    * Get the page.
    *
    */
    $page = Page::find($id);

    /**
    * Get array of widgets ids already on this page.
    *
    */
    $ids = PageWidget::where("page_id", $page->id)
      ->get()
      ->pluck("widget_id")
      ->toArray();

    /**
    * Get list of widgets.
    *
    */
    $widgets = Widget::whereNotIn("id", $ids)
      ->get();

    /**
    * Display page.
    *
    */
    return view("admin.pages.widgets.add-to-page", compact(
      "page",
      "widgets"
    ));

  }

  /**
  * Insert a widget onto a page.
  *
  */
  public function insertWidget($id, Request $request) {

    /**
    * Add to storage.
    *
    */
    $widget = PageWidget::create([
      "page_id" => request()->page_id,
      "widget_id" => request()->widget_id,
      "is_visible" => 0,
    ]);

    /**
    * Redirect back to the edit page view.
    *
    */
    return redirect(route("pages.edit", request()->page_id));

  }

}
