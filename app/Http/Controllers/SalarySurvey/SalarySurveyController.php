<?php

namespace App\Http\Controllers\SalarySurvey;

use App\Models\Page;
use App\Http\Controllers\Controller;

class SalarySurveyController extends Controller
{
  /**
  * Display main salary survey content page.
  * @return \Illuminate\View\View
  */
    public function index()
    {
        // Get page information.
        $page = Page::getPage(request()->route()->uri);

        // Set SEO.
        $this->seo()->setTitle($page->meta_title);
        $this->seo()->setDescription($page->meta_description);
        $this->seo()->opengraph()->addImage($page->section->image);

        // Get adverts for this page.
        $page_adverts = getArrayOfAdverts($page->id);

        // Display page.
        return view("salary-survey.index", compact(
          "page",
          "page_adverts"
        ))->compileShortcodes();
    }
}
