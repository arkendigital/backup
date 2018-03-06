<?php

namespace App\Http\Controllers\Admin\Pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Page;
use App\Models\PageField;
use App\Models\PageAdvert;
use App\Models\Section;
use App\Models\DiscussionCategory;

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
    return redirect(route("pages.edit", compact(
      "page"
    )));

  }

  /**
  * Show page edit form / page.
  *
  * @param Page $page
  *
  */
  public function edit(Page $page) {

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
  * @param Page $page
  * @param Request $request
  *
  */
  public function update(Page $page, Request $request) {

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
    * Redirect to page edit form.
    */
    return redirect(route("pages.edit", compact(
      "page"
    )));

  }

}
