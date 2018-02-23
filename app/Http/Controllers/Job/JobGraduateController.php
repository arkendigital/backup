<?php

namespace App\Http\Controllers\Job;

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

class JobGraduateController extends Controller {

  /**
  * Define the section.
  */
  public function __construct() {

    $this->section = Section::where("slug", "jobs")
      ->first();

  }

  public function index() {

    /**
    * Get page Information
    */
    $page = Page::where("slug", "jobs-graduate-jobs")
      ->first();

    /**
    * Set seo.
    */
    $this->seo()->setTitle($page->meta_title);
    $this->seo()->setDescription($page->meta_description);

    /**
    * Display page.
    */
    return view("job.graduate.index", compact(
      "page"
    ));

  }

}
