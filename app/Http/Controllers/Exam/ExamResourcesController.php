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
use App\Models\ExamResource;

class ExamResourcesController extends Controller {

  /**
  * Set SEO for pages.
  *
  * @param object $page
  *
  */
  private function set_seo($page) {

    $this->seo()->setTitle($page->meta_title);
    $this->seo()->setDescription($page->meta_description);

  }

  public function index() {

    /**
    * Get page Information
    */
    $page = Page::where("slug", "exams-resources")
      ->first();

    /**
    * Set seo.
    */
    $this->set_seo($page);

    /**
    * Get a list of resources.
    */
    $resources = ExamResource::all();

    /**
    * Display page.
    */
    return view("exam.resources.index", compact(
      "page",
      "resources"
    ));

  }

  /**
  * Display a specific exam resource.
  *
  * @param ExamResource $exam_resource
  *
  */
  public function view(ExamResource $exam_resource) {

    /**
    * Get section.
    */
    $section = Section::where("slug", "exam")
      ->first();

    return view("exam.resources.view", [
      "resource" => $exam_resource,
      "section" => $section
    ]);

  }

}
