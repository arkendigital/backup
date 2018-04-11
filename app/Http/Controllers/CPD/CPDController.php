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
use App\Models\Page;

class CPDController extends Controller
{
    public function index()
    {

    /**
    * Get page Information
    */
        $page = Page::where("slug", "cpd")
            ->first();

        /**
        * Set seo.
        */
        $this->seo()->setTitle($page->meta_title);
        $this->seo()->setDescription($page->meta_description);

        /**
        * Display page.
        */
        return view("cpd.index", compact(
            "page"
        ));
    }
}
