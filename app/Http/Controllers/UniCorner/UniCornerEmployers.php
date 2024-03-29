<?php

namespace App\Http\Controllers\UniCorner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Section;
use App\Models\Page;
use App\Models\Employer;

class UniCornerEmployers extends Controller
{

    /**
    * Show page with a list of actuarial employers.
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
        $this->seo()->opengraph()->addImage($page->section->image);

        /**
        * Get adverts for this page.
        */
        $page_adverts = getArrayOfAdverts($page->id);

        /**
        * Get a list of societies / employers.
        *
        */
        $employers = Employer::orderBy("name", "ASC")
          ->get();

        return view("uni-corner.employers", compact(
            "page",
            "page_adverts",
            "employers"
        ))->compileShortcodes();
    }

    /**
    * Display view page for an employer.
    *
    * @param Employer $employer
    *
    */
    public function view(Employer $employer)
    {

    /**
    * Get page Information
    */
        $page = Page::getPage("employer-view");

        /**
        * Set seo.
        */
        $this->seo()->setTitle($employer->name);
        $this->seo()->setDescription($employer->description);

        /**
        * Get section.
        *
        */
        $section = Section::where("slug", "uni-corner")
            ->first();

        /**
        * Get a list of societies / employers.
        *
        */
        $employers = Employer::all();

        /**
        * Show page.
        *
        */
        return view("uni-corner.employer", compact(
            "employer",
            "employers",
            "section",
            "page"
        ))->compileShortcodes();
    }
}
