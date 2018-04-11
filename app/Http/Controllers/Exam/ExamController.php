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

class ExamController extends Controller
{

  /**
  * Define the section.
  */
    public function __construct()
    {
        $this->section = Section::where("slug", "exam")
          ->first();
    }

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
        $page = Page::where("slug", "exams")
            ->first();

        /**
        * Set seo.
        */
        $this->set_seo($page);

        /**
        * Get adverts for this page.
        */
        $page_adverts = getArrayOfAdverts($page->id);

        /**
        * Display page.
        */
        return view("exam.index", [
            "section" => $this->section,
            "page" => $page,
            "page_adverts" => $page_adverts
        ]);
    }
}
