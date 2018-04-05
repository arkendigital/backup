<?php

namespace App\Http\Controllers;

/**
* Load models.
*
*/
use App\Models\Page;
use App\Models\Section;
use App\Models\Discussion;
use App\Models\Slide;

class HomeController extends Controller
{

  /**
  * Show the application dashboard.
  *
  * @return \Illuminate\Http\Response
  */
    public function index()
    {

    /**
    * Get page information.
    *
    */
        $page = Page::getPage("homepage");

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

        /**
        * Get a list of sections.
        *
        */
        $sections = Section::all();

        /**
        * Get a list of discussions.
        *
        */
        $discussions = Discussion::with('category')->take(8)
      ->get();

        /**
        * Show the homepage!!!
        *
        */
        return view("welcome", compact(
      "sections",
      "discussions",
      "slides",
      "page"
    ));
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
