<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\Section;
use App\Models\Discussion;
use App\Models\Slide;
use App\Models\WealthOfInformation;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $page = Page::getPage("homepage");
        $exams = Page::where('slug', 'exams')->first();

        /**
        * Set SEO.
        *
        */
        $this->seo()->setTitle($page->meta_title);

        /**
        * Get slides for the homepage.
        *
        */
        $slides = Slide::where("slug", "home")
            ->get();

        if (isset($slides[0]) && isset($slides[0]->image_path) && $slides[0]->image_path != "") {
            $this->seo()->opengraph()->addImage(env("S3_URL").$slides[0]->image_path);
        }

        /**
        * Get a list of sections.
        *
        */
        $sections = Section::orderBy("order", "ASC")
          ->get();

        /**
        * Get a list of discussions.
        *
        */
        $discussions = Discussion::with('category')->take(8)
            ->get();


        $wealth_of_information = WealthOfInformation::all();

        /**
        * Show the homepage!!!
        *
        */
        return view("welcome", compact(
            "sections",
            "discussions",
            "slides",
            "page",
            'exams',
            'wealth_of_information'
        ))->compileShortcodes();
    }

    /**
    * Show the application dashboard.
    *
    * @return \Illuminate\Http\Response
    */
    public function home()
    {
        return view('home');
    }
}
