<?php

namespace App\Http\Controllers\CVSupport;

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

class CVSupportController extends Controller
{

  /**
  * Define the section.
  */
    public function __construct()
    {
        $this->section = Section::where("slug", "cv-support")
            ->first();
    }

    public function index()
    {

    /**
    * Get page Information
    */
        $page = Page::where("slug", "cv-support")
            ->first();

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
        * Display page.
        */
        return view("cvsupport.index", [
            "section" => $this->section,
            "page" => $page,
            "page_adverts" => $page_adverts
        ])->compileShortcodes();
    }
}
