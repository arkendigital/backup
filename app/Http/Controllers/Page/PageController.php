<?php

namespace App\Http\Controllers\Page;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;

class PageController extends Controller
{
	//function to show custom pages where it has to be added to routes manually
    public function show(Page $page)
    {
        return redirect()->to($page->slug);
    }
    
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

    // function to show auto generated pages with unified prefix
    public function showPage($slug)
    {
    	/**
	    * Get page Information
	    */
        $page = Page::where("slug", 'actuaries/'.$slug)
            ->first();

        /**
        * Set seo.
        */
        $this->set_seo($page);

        /**
        * Get adverts for this page.
        */
        $page_adverts = getArrayOfAdverts($page->id);

        /**
        * Display page.
        */
        return view("pages.show", [
            "section" => $page->section,
            "page" => $page,
            "page_adverts" => $page_adverts
        ])->compileShortcodes();
    }
}
