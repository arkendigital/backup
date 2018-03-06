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

class UniCornerController extends Controller {

  /**
  * Define the section.
  */
  public function __construct() {

    $this->section = Section::where("slug", "uni-corner")
      ->first();

  }

  public function index() {

    /**
    * Get page Information
    */
    $page = Page::where("slug", "uni-corner")
      ->first();

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
    * Display page.
    */
    return view("uni-corner.index", compact(
      "page",
      "page_adverts"
    ));

  }

}
