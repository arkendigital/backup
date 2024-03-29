<?php

namespace App\Http\Controllers\CPD;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
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
        $this->seo()->opengraph()->addImage($page->section->image);

        /**
        * Get links.
        *
        */
        $links = Link::all();

        /**
        * Get adverts for this page.
        *
        */
        $page_adverts = getArrayOfAdverts($page->id);

        /**
        * Display page.
        *
        */
        return view("cpd.links.index", compact(
            "links",
            "page",
            "page_adverts"
        ))->compileShortcodes();
    }
}
