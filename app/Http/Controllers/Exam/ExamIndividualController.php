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
use App\Models\Exam\Category as ExamCategory;
use App\Models\Exam\Module as ExamModule;

class ExamIndividualController extends Controller
{

  /**
  * Display the page.
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
        * Exam category.
        *
        */
        if (!isset($category->id)) {
            $category = collect();
            $categories = ExamCategory::all();
        } else {
            $categories = collect();
        }

        /**
        * Display results.
        */
        return view("exam.individual.index", compact(
            "page",
            "page_adverts",
            "category",
            "categories"
        ));
    }

    /**
    * Display a list of exam categories.
    *
    */
    public function moduleList($slug)
    {

    /**
    * Get page Information
    */
        $page = Page::getPage("exams/individual-exams");

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
        * Get exam category.
        *
        */
        $categories = collect();
        $category = ExamCategory::where("slug", $slug)
            ->first();

        /**
        * Sections.
        *
        */
        $module_sections = [
            "one",
            "two",
            "three",
            "four"
        ];

        /**
        * Display page.
        *
        */
        return view("exam.individual.index", compact(
            "page",
            "page_adverts",
            "category",
            "categories",
            "module_sections"
        ));
    }
}
