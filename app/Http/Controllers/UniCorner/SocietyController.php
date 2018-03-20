<?php

namespace App\Http\Controllers\UniCorner;

/**
* Load modules.
*/
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

/**
* Load models.
*/
use App\Models\Section;
use App\Models\Page;
use App\Models\Society;

class SocietyController extends Controller {

  /**
  * Display the main societies page.
  *
  */
  public function index() {

    /**
    * Get page Information
    */
    $page = Page::getPage(request()->route()->uri);

    /**
    * Set seo.
    */
    $this->seo()->setTitle($page->meta_title);
    $this->seo()->setDescription($page->meta_description);

    /**
    * Get adverts for this page.
    */
    $page_adverts = getArrayOfAdverts($page->id);

    /**
    * Get a list of societies.
    *
    */
    $societies = Society::all();

    return view("uni-corner.societies.index", compact(
      "page",
      "societies"
    ));

  }

  /**
  * Display a specific course.
  *
  * @param Society $society
  *
  */
  public function view(Society $society) {

    /**
    * Get page Information
    */
    $page = Page::getPage("society-view");

    /**
    * Set seo.
    */
    $this->seo()->setTitle($society->name);
    $this->seo()->setDescription($society->description);

    /**
    * Get section.
    *
    */
    $section = Section::where("slug", "uni-corner")
      ->first();

    /**
    * Get a list of societies.
    *
    */
    $societies = Society::all();

    /**
    * Show page.
    *
    */
    return view("uni-corner.societies.view", compact(
      "society",
      "societies",
      "page",
      "section"
    ));

  }

}
