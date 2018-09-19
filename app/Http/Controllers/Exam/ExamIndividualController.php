<?php

namespace App\Http\Controllers\Exam;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
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
        $this->seo()->opengraph()->addImage($page->section->image);

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
        ))->compileShortcodes();
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
         * Check this exam category exists
         *
         */
        if (null === $category) {
            return view("errors.404");
            die();
        }

        /**
        * Sections.
        *
        */
        $module_sections = [
            "one",
            "two",
            "three",
            "four",
            "five"
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
        ))->compileShortcodes();
    }
}
