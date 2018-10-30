<?php

namespace App\Http\Controllers\Job;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Section;
use App\Models\Page;
use App\Models\Job;
use App\Models\JobLocation;
use App\Models\JobSector;
use App\Models\JobCompany;
use App\Models\JobRegion;
use App\Models\JobStatus;

class JobVacanciesController extends Controller
{

    /**
    * Define the section.
    */
    public function __construct()
    {
        $this->section = Section::where("slug", "jobs")
            ->first();
    }

    /**
    * Show a list of jobs.
    */
    public function index()
    {
        /**
        * Get page Information
        */
        $page = Page::getPage(request()->route()->uri);

        /**
        * Set seo.
        */
        $this->seo()->setTitle($page->meta_title);
        $this->seo()->setDescription($page->meta_description);

        $sectors = JobSector::orderBy('name')->get();

        /**
        * Get featured jobs.
        */
        $featured_jobs = Job::with('company', 'location', 'sector')
                            ->where("featured", 1)
                            ->get();

        /**
        * Get jobs.
        */
        $jobs = Job::with('company', 'location', 'sector')
            ->where("featured", 0)
            ->where("start_date", "<=", now())
            ->where("end_date", ">=", now());

        /**
         * Get a list of job locations that have active jobs
         */
        $locations = Job::select("location_id")
                        ->groupBy("location_id")
                        ->get()
                        ->pluck("location_id");

        $locations = JobLocation::whereIn("id", $locations)
                                ->get();

        $locations = JobLocation::all();

        /**
         * Get a list of regions that have active jobs
         */
        $regions = Job::select("region_id")
                     ->groupBy("region_id")
                     ->get()
                     ->pluck("region_id");

        $regions = JobRegion::whereIn("id", $regions)
                            ->get();

        $regions = JobRegion::all();

        /**
        * Apply filtering.
        */
        if (session()->exists("job-filter-keyword") && session()->get("job-filter-keyword") != "") {
            $jobs = $jobs->where("title", "LIKE", "%".session()->get("job-filter-keyword")."%");
        }

        if (session()->exists("job-filter-status") && !empty(session()->get("job-filter-status"))) {
            $jobs = $jobs->whereIn("status_id", session()->get("job-filter-status"));
        }

        if (session()->exists("job-filter-experience") && !empty(session()->get("job-filter-experience"))) {
            $jobs = $jobs->whereIn("experience", session()->get("job-filter-experience"));
        }

        if (session()->exists("job-filter-type") && !empty(session()->get("job-filter-type")) && session()->get("job-filter-type") != "topsearch") {
            $jobs = $jobs->whereIn("type", session()->get("job-filter-type"));
        }

        if (session()->exists('job-filter-sector') && !empty(session()->get('job-filter-sector'))) {
            $jobs = $jobs->where('sectors', 'LIKE', '%'.session()->get('job-filter-sector').',%');
        }

        if (session()->exists('job-filter-salary-min') && !empty(session()->get('job-filter-salary-min'))) {
            $jobs = $jobs->where('max_salary', ">=", session()->get('job-filter-salary-min'));
            $jobs = $jobs->where('max_salary', "<=", session()->get('job-filter-salary-max'));
        }

        if (session()->exists('job-filter-contract-salary-min') && !empty(session()->get('job-filter-contract-salary-min'))) {
            $jobs = $jobs->orWhere('max_daily_salary', ">=", session()->get('job-filter-contract-salary-min'));
            $jobs = $jobs->orWhere('max_daily_salary', "<=", session()->get('job-filter-contract-salary-max'));
        }

        if (session()->exists('job-filter-region') && session()->get('job-filter-region') != '') {
            $jobs = $jobs->where("region_id", session()->get("job-filter-region"));
        }

        if (session()->exists('job-filter-location') && session()->get('job-filter-location') != '') {
            $jobs = $jobs->where("location_id", session()->get("job-filter-location"));
        }

        /*
         * This code is for the old location search which is free type
        if (session()->exists('job-filter-location') && session()->get('job-filter-location') != '') {
            $jobs = $jobs->whereHas('location', function ($q) {
                $q->where('name', 'LIKE', '%' . session()->get('job-filter-location') . '%');
            });
        }
        */

        if (!session()->exists('job-filter-order')) {
            session()->put("job-filter-order", 'created_at-desc');
        }

        if (session()->exists('job-filter-order') && !empty(session()->get('job-filter-order'))) {
            $order = explode('-', session()->get('job-filter-order'));
            $jobs = $jobs->orderBy($order[0], $order[1]);
        }

        $jobs = $jobs->paginate(6);

        /**
         * Get a list of job types
         */
        $job_types = JobStatus::all();

        /**
        * Get adverts for this page.
        */
        $page_adverts = getArrayOfAdverts($page->id);

        /**
        * Display results.
        */
        return view("job.vacancies.index", compact(
            "featured_jobs",
            "jobs",
            "page",
            "section",
            "sectors",
            "locations",
            "regions",
            "job_types",
            "page_adverts"
        ))->compileShortcodes();
    }

    /**
    * Set job search filtering.
    *
    * @param Request $request
    *
    */
    public function set_filtering(Request $request)
    {
        // if (isset(request()->type) && !isset(request()->sector)) {
        // session()->put("job-filter-location", request()->location);
        // session()->put("job-filter-order", request()->order);
        // } else {
        session()->put("job-filter-keyword", request()->keyword);
        session()->put("job-filter-status", request()->status);
        session()->put("job-filter-experience", request()->experience);
        session()->put("job-filter-type", request()->type);
        session()->put("job-filter-sector", request()->sector);

        if (str_contains(request()->location, "all-region")) {
            session()->forget("job-filter-location");

            $region_string = request()->location;
            $region_id = explode("-", $region_string)[2];
            session()->put("job-filter-region", $region_id);
        } else {
            session()->put("job-filter-location", request()->location);
            session()->forget("job-filter-region");
        }

        /**
         * Permanent salary
         *
         */
        if (request()->salary != "all" && request()->salary !== null) {
            $salary = explode("-", request()->salary);

            session()->put("job-filter-salary-min", $salary[0]);
            session()->put("job-filter-salary-max", $salary[1]);
        } else {
            session()->forget("job-filter-salary-min");
            session()->forget("job-filter-salary-max");
        }

        /**
         * Contractor salary
         *
         */
        if (request()->daily_salary != "all" && request()->daily_salary !== null) {
            $salary = explode("-", request()->daily_salary);

            session()->put("job-filter-contract-salary-min", $salary[0]);
            session()->put("job-filter-contract-salary-max", $salary[1]);
        } else {
            session()->forget("job-filter-contract-salary-min");
            session()->forget("job-filter-contract-salary-max");
        };

        // }


        /**
        * Redirect back to job listing page.
        */
        return redirect("/jobs/vacancies#jobs");
    }

    /**
    * Display a specific job to user.
    *
    * @param Job $job
    *
    */
    public function view(Job $job)
    {

    /**
    * Get page information.
    *
    */
        $page = Page::getPage("jobs-vacancy-view");

        /**
        * Set SEO.
        *
        */
        $this->seo()->setTitle($job->title);
        $this->seo()->setDescription($job->excerpt);

        /**
        * Display job.
        */
        return view("job.vacancies.view", compact(
            "job",
            "page"
        ))->compileShortcodes();
    }
}
