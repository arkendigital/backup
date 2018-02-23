<?php

namespace App\Http\Controllers\Exam;

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
use App\Models\ExamUsefulLink;

class ExamLinksController extends Controller {

  public function index() {

    /**
    * Get page Information
    */
    $page = Page::where("slug", "exams-links")
      ->first();

    /**
    * Set SEO.
    */
    $this->seo()->setTitle($page->meta_title);
    $this->seo()->setDescription($page->meta_description);

    /**
    * Get list official useful links.
    */
    $official_links = ExamUsefulLink::where("official", 1)
      ->get();

    /**
    * Get list non-official useful links.
    */
    $unofficial_links = ExamUsefulLink::where("official", 0)
      ->get();

    /**
    * Display results.
    */
    return view("exam.links.index", compact(
      "page",
      "official_links",
      "unofficial_links"
    ));

  }

}
