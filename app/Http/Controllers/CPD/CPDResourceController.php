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
use App\Models\CPDResource;

class CPDResourceController extends Controller
{

  /**
  * Set SEO for pages.
  *
  * @param object $page
  *
  */
    private function set_seo($page)
    {
        $this->seo()->setTitle($page->meta_title);
        $this->seo()->setDescription($page->meta_description);
        $this->seo()->opengraph()->addImage($page->section->image);
    }

    public function index()
    {

    /**
    * Get page Information
    */
        $page = Page::getPage(request()->route()->uri);

        /**
        * Set seo.
        */
        $this->set_seo($page);

        /**
        * Get a list of resources.
        */
        $resources = CPDResource::all();

        /**
        * Get adverts for this page.
        */
        $page_adverts = getArrayOfAdverts($page->id);

        /**
        * Display page.
        */
        return view("cpd.resources.index", compact(
            "page",
            "resources",
            "page_adverts"
        ))->compileShortcodes();
    }

    /**
    * Display a specific exam resource.
    *
    * @param CPDResource $cpd_resource
    *
    */
    public function view(CPDResource $cpd_resource)
    {

    /**
    * Get section.
    */
        $section = Section::where("slug", "cpd")
            ->first();

        /**
        * Set SEO.
        */
        $this->seo()->setTitle($cpd_resource->name);
        $this->seo()->setDescription($cpd_resource->excerpt);

        return view("cpd.resources.view", [
            "resource" => $cpd_resource,
            "section" => $section
        ])->compileShortcodes();
    }
}
