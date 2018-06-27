<?php

namespace App\Http\Controllers\Exam;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Section;
use App\Models\Page;
use App\Models\Survey;
use App\Models\Exam\Category as ExamCategory;

class ExamSurveyController extends Controller
{

  /**
  * Display page with survey on.
  *
  */
    public function index()
    {

    /**
    * Get page Information
    */
        $page = Page::getPage(request()->route()->uri);

        /**
        * Set SEO.
        */
        $this->seo()->setTitle($page->meta_title);
        $this->seo()->setDescription($page->meta_description);

        /**
        * Get adverts for this page.
        */
        $page_adverts = getArrayOfAdverts($page->id);

        /**
        * Get exam categories.
        *
        */
        $categories = ExamCategory::all();

        /**
        * Display page with form.
        *
        */
        return view("exam.survey.index", compact(
            "page",
            "page_adverts",
            "categories"
        ));
    }

    /**
    * Submit survey form.
    *
    * @param Request $request
    *
    */
    public function submit(Request $request)
    {

    /**
    * Add result to database.
    *
    */
        $survey = Survey::create([
            "module_id" => request()->module_id,
            "difficulty" => request()->difficulty
        ]);

        return "OK";
    }

    /**
    * Display survey results.
    *
    */
    public function results()
    {

    /**
    * Get page Information
    */
        $page = Page::getPage(request()->route()->uri);

        /**
        * Set SEO.
        */
        $this->seo()->setTitle($page->meta_title);
        $this->seo()->setDescription($page->meta_description);

        /**
        * Get adverts for this page.
        */
        $page_adverts = getArrayOfAdverts($page->id);

        /**
        * Get exam categories.
        *
        */
        $categories = ExamCategory::all();

        /**
        * Display page with form.
        *
        */
        return view("exam.survey.results", compact(
            "page",
            "page_adverts",
            "categories"
        ));
    }
}
