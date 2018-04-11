<?php

namespace App\Http\Controllers\Societies;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Section;
use App\Models\Page;
use App\Models\Society;

class SocietyController extends Controller
{
    public function index()
    {
        $page = Page::getPage(request()->route()->uri);

        /**
        * Set seo.
        *
        */
        $this->seo()->setTitle($page->meta_title);
        $this->seo()->setDescription($page->meta_description);

        /**
        * Get adverts for this page.
        *
        */
        $page_adverts = getArrayOfAdverts($page->id);

        /**
        * Get a list of societies.
        *
        */
        $societies = Society::paginate(8);

        /**
        * Display page.
        *
        */
        return view("societies.index", compact(
            "page",
            "societies"
        ));
    }

    /**
    * Display individual society.
    *
    * @param Society $society
    *
    */
    public function view(Society $society)
    {

    /**
    * Get page Information
    */
        $page = Page::getPage("society-view");

        /**
        * Set seo.
        */
        $this->seo()->setTitle($society->name);
        $this->seo()->setDescription($society->description);

        /**
        * Get section.
        *
        */
        $section = Section::where("slug", "regional-societies")
            ->first();

        /**
        * Get a list of societies.
        *
        */
        $societies = Society::all();

        /**
        * Display the society.
        *
        */
        return view("societies.view", compact(
            "society",
            "societies",
            "page",
            "section"
        ));
    }

    /**
    * Search for societies and display on map.
    *
    * @param Request $request
    *
    */
    public function search(Request $request)
    {

    /**
    * Define the search parameter.
    *
    */
        $search = request()->search;

        /**
        * Search for societies based on...
        * - name
        * - location
        */
        $merged = Society::where('name', 'LIKE', "%$search%")
            ->orWhere('city', 'LIKE', "%$search%")
            ->get();

        /**
        * Return the results for the ajax to populate the map.
        *
        */
        return json_encode($merged);
    }
}
