<?php

namespace App\Http\Controllers\SalarySurvey;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Section;
use App\Models\Page;
use App\Models\SalarySurvey;

class TakePartController extends Controller
{

    /**
     * Display the page with the questionnaire.
     *
     */
    public function index()
    {
        $page = Page::getPage(request()->route()->uri);

        $this->seo()->setTitle($page->meta_title);
        $this->seo()->setDescription($page->meta_description);

        $page_adverts = getArrayOfAdverts($page->id);

        return view("salary-survey.survey", compact(
            "page",
            "page_adverts"
        ));
    }

    /**
    * Submission of questionnaire form.
    *
    * @param Request $request
    *
    */
    public function submit(Request $request)
    {
        // @todo: No validation
        if (auth()->check()) {
            $user_id = auth()->user()->id;
        } else {
            $user_id = 0;
        }

        // Add answers to database.
        $answers = SalarySurvey::create([
            "type" => request()->type,
            "sector" => request()->sector,
            "field" => request()->field,
            "experience" => request()->experience,
            "qualifications" => request()->qualifications,
            "annual_salary" => request()->annual_salary,
            "daily_salary" => request()->daily_salary,
            "user_id" => $user_id
        ]);

        return "OK";
    }
}
