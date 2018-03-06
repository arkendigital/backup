<?php

namespace App\Http\Controllers\CPD;

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
use App\Models\CPDPublication;

class CPDPublicationController extends Controller {

  /**
  * Display a list of current publications.
  *
  */
  public function index() {

    /**
    * Get page information.
    *
    */
    $page = Page::getPage("cpd-publications");

    /**
    * Set SEO.
    *
    */
    $this->seo()->setTitle($page->meta_title);
    $this->seo()->setDescription($page->meta_description);

    /**
    * Get publications.
    *
    */
    $publications = CPDPublication::all();

    /**
    * Display results.
    *
    */
    return view("cpd.publications.index", compact(
      "publications",
      "page"
    ));

  }

}
