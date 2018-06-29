<?php

namespace App\Http\Controllers\Misc;

/**
* Load modules.
*/
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

/**
* Load models.
*/
use App\Models\Page;

class AboutController extends Controller
{

  /**
  * Display page.
  *
  */
    public function index()
    {

    /**
    * Get page information.
    *
    */
        $page = Page::getPage("about");


        /**
        * Set SEO.
        *
        */
        $this->seo()->setTitle($page->meta_title);
        $this->seo()->setDescription($page->meta_description);

        /**
        * Show page.
        *
        */
        return view("misc.about", compact(
            "page"
        ))->compileShortcodes();
    }
}
