<?php

namespace App\Http\Controllers\CPD;

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
use App\Models\CPD\Link;

class CPDLinkController extends Controller
{

  /**
  * Display a list of useful links.
  *
  */
    public function index()
    {

    /**
    * Get page information.
    *
    */
        $page = Page::getPage(request()->route()->uri);

        /**
        * Get SEO.
        *
        */
        $this->seo()->setTitle($page->meta_title);
        $this->seo()->setDescription($page->meta_description);

        /**
        * Get links.
        *
        */
        $links = Link::all();

        /**
        * Display page.
        *
        */
        return view("cpd.links.index", compact(
      "links",
      "page"
    ));
    }
}
