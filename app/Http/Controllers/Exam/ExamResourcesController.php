<?php

namespace App\Http\Controllers\Exam;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Section;
use App\Models\Page;
use App\Models\ExamResource;

class ExamResourcesController extends Controller
{

  /**
  * Set SEO for pages.
  *
  * @param object $page
  *
  */
    private function set_seo($page)
    {
        $this->seo()->setTitle($page->meta_title);
        $this->seo()->setDescription($page->meta_description);
    }

    public function index()
    {

    /**
    * Get page Information
    */
        $page = Page::getPage(request()->route()->uri);

        /**
        * Set seo.
        */
        $this->set_seo($page);

        /**
        * Get a list of resources.
        */
        $resources = ExamResource::all();

        /**
        * Get adverts for this page.
        */
        $page_adverts = getArrayOfAdverts($page->id);

        /**
        * Display page.
        */
        return view("exam.resources.index", compact(
            "page",
            "resources",
            "page_adverts"
        ))->compileShortcodes();
    }

    /**
    * Display a specific exam resource.
    *
    * @param ExamResource $exam_resource
    *
    */
    public function view(ExamResource $exam_resource)
    {

      /**
       * Set page SEO
       *
       */
        $this->seo()
        ->setTitle($exam_resource->name . "- Exam Resources");

        /**
         * Get section
         *
         */
        $section = Section::where("slug", "exams")
            ->first();

        return view("exam.resources.view", [
            "resource" => $exam_resource,
            "section" => $section
        ])->compileShortcodes();
    }
}
