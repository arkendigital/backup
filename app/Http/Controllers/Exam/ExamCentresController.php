<?php

namespace App\Http\Controllers\Exam;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Section;
use App\Models\Page;
use App\Models\ExamCentre;

class ExamCentreController extends Controller
{

    /**
    * Display the main exam centres page.
    *
    */
    public function index()
    {

        /**
        * Get page information.
        *
        */
        $page = Page::getPage("exam-centres");

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
        * Display page.
        *
        */
        return view('exam.centres.index')->with(compact('page'));
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
        *
        */
        $merged = ExamCentre::where("name", "LIKE", "%$search%")
            ->orWhere("city", "LIKE", "%$search%")
            ->get();


        /**
        * Return the results for the ajax to populate the map.
        *
        */
        return json_encode($merged);
    }
}
