<?php

namespace App\Http\Controllers\SalarySurvey;

use Cache;
use App\Models\Page;
use Illuminate\Http\Request;
use App\Models\SalarySurvey;
use App\Http\Controllers\Controller;

class TakePartController extends Controller
{

    /**
     * Display the page with the questionnaire.
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
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
     * @param Request $request
     * @return string
     */
    public function submit(Request $request)
    {
        // @todo: Add validation
        // Add answers to database.
        SalarySurvey::create([
            "type" => $request->type,
            "sector" => $request->sector,
            "field" => $request->field,
            "experience" => $request->experience,
            "qualifications" => $request->qualifications,
            "annual_salary" => $request->annual_salary,
            "daily_salary" => $request->daily_salary,
            "user_id" => auth()->check() ? auth()->id() : 0,
        ]);

        /**
         * Bust cache for particular form that will be updated
         *
         */
        Cache::forget('average_salary_sector_' . $request->sector . '_' . $request->type);
        Cache::forget('average_salary_per_sector_' . $request->type);
        Cache::forget('average_salary_per_field_' . $request->type);
        Cache::forget('average_salary_vs_exams_' . $request->type);

        // @todo: Actually return JSON object for use in front end
        return response()->json('OK', 200);
    }
}
