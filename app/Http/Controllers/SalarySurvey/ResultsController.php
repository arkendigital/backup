<?php

namespace App\Http\Controllers\SalarySurvey;

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
use App\Models\SalarySurvey;

class ResultsController extends Controller {

  /**
  * Display results page.
  *
  */
  public function index() {

    /**
    * Get page information.
    *
    */
    $page = Page::getPage(request()->route()->uri);

    /**
    * Set SEO.
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
    * Get graph results.
    *
    * - Average Salary vs Experience (graph_one)
    *
    */
    $graph_one = $this->resultsGraphOne();


    /**
    * Display page and results.
    *
    */
    return view("salary-survey.results", compact(
      "page",
      "page_adverts",
      "graph_one"
    ));

  }


  /**
  * Get results for graph 1.
  *
  */
  private function resultsGraphOne() {

    $results = new \stdClass();

    $results->one_four = round(SalarySurvey::where("experience", "1-4")
      ->avg("annual_salary"));

    $results->five_nine = round(SalarySurvey::where("experience", "5-9")
      ->avg("annual_salary"));

    $results->ten_fourteen = round(SalarySurvey::where("experience", "10-14")
      ->avg("annual_salary"));

    $results->fifteen_ninteen = round(SalarySurvey::where("experience", "15-19")
      ->avg("annual_salary"));

    $results->twenty_plus = round(SalarySurvey::where("experience", "20+")
      ->avg("annual_salary"));

      // dd($results);

    return $results;

  }

}
