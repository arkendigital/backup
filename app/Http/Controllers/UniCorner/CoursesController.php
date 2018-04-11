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
use App\Models\Course;

class CoursesController extends Controller
{

  /**
  * Display the main courses page.
  *
  */
    public function index()
    {

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
        * Get a list of courses.
        *
        */
        $courses = Course::all();

        return view("uni-corner.courses.index", compact(
            "page",
            "courses"
        ));
    }

    /**
    * Display a specific course.
    *
    * @param Course $course
    *
    */
    public function view(Course $course)
    {
        return view("uni-corner.courses.view", compact(
            "course"
        ));
    }
}
