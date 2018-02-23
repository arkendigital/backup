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
use App\Models\Page;

class JobInternshipController extends Controller {

  public function index() {

    /**
    * Get page Information
    */
    $page = Page::where("slug", "jobs-internships")
      ->first();

    /**
    * Set seo.
    */
    $this->seo()->setTitle($page->meta_title);
    $this->seo()->setDescription($page->meta_description);

    /**
    * Display page.
    */
    return view("job.internship.index", compact(
      "page"
    ));

  }

}
