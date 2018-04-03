<?php

namespace App\Http\Controllers\SalarySurvey;

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
use App\Models\Course;

class SalarySurveyController extends Controller {

  /**
  * Display main salary survey content page.
  *
  */
  public function index() {

    /**
    * Get page information.
    *
    */
    $page = Page::getPage(request()->route()->uri);

    /**
    * Set SEO.
    *
    */
    $this->seo()->setTitle($page->meta_title);
    $this->seo()->setDescription($page->meta_description);

    /**
    * Get adverts for this page.
    *
    */
    $page_adverts = getArrayOfAdverts($page->id);

    /**
    * Display page.
    *
    */
    return view("salary-survey.index", compact(
      "page",
      "page_adverts"
    ));

  }

}
