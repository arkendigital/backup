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
            ->orderBy('sort_order', 'asc')
            ->get();

        /**
        * Get jobs.
        */
        $jobs = Job::with('company', 'location', 'sector')
            ->where("start_date", "<=", now())
            ->orderBy('sort_order', 'asc')
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

        $isSearching = false;
        /**
        * Apply filtering.
        */
        if (session()->exists("job-filter-keyword") && session()->get("job-filter-keyword") != "") {
            $isSearching = true;
            $jobs = $jobs->where("title", "LIKE", "%".session()->get("job-filter-keyword")."%");
        }

        if (session()->exists("job-filter-status") && !empty(session()->get("job-filter-status"))) {
            $isSearching = true;
            $jobs = $jobs->whereIn("status_id", session()->get("job-filter-status"));
        }

        if (session()->exists("job-filter-experience") && !empty(session()->get("job-filter-experience"))) {
            $isSearching = true;

            $jobsArray = [];
            $allJobs = Job::get();

            foreach ($allJobs as $key => $jobItem) {
              if(array_intersect(json_decode($jobItem->experience, true), session()->get("job-filter-experience"))){
                $jobsArray[] = $jobItem;
              }
            }
            
            $jobs = $jobs->whereIn("id", collect($jobsArray)->pluck('id'));
        }

        if (session()->exists("job-filter-type") && !empty(session()->get("job-filter-type")) && session()->get("job-filter-type") != "topsearch") {
            $isSearching = true;
            $jobs = $jobs->whereIn("type", session()->get("job-filter-type"));
        }

        if (session()->exists('job-filter-sector') && !empty(session()->get('job-filter-sector'))) {
            $isSearching = true;
            $jobs = $jobs->where('sectors', 'LIKE', '%'.session()->get('job-filter-sector').',%');
        }

        if (session()->exists('job-filter-salary-min') && !empty(session()->get('job-filter-salary-min'))) {
            $isSearching = true;
            $jobs = $jobs->where('max_salary', ">=", session()->get('job-filter-salary-min'));
            $jobs = $jobs->where('max_salary', "<=", session()->get('job-filter-salary-max'));
        }

        if (session()->exists('job-filter-contract-salary-min') && !empty(session()->get('job-filter-contract-salary-min'))) {
            $isSearching = true;
            $jobs = $jobs->orWhere('max_daily_salary', ">=", session()->get('job-filter-contract-salary-min'));
            $jobs = $jobs->orWhere('max_daily_salary', "<=", session()->get('job-filter-contract-salary-max'));
        }

        if (session()->exists('job-filter-region') && session()->get('job-filter-region') != '') {
            $isSearching = true;
            $jobs = $jobs->where("region_id", session()->get("job-filter-region"));
        }

        if (session()->exists('job-filter-location') && session()->get('job-filter-location') != '') {
            $isSearching = true;
            $jobs = $jobs->where("location_id", session()->get("job-filter-location"));
        }

        if (session()->get('job-filter-order')) {
            $isSearching = true;
            $order = explode('-', session()->get('job-filter-order'));
            $jobs = $jobs->orderBy($order[0], $order[1]);
        }

        $perPage = (session()->exists("job-per-page")) ? session('job-per-page') : 10 ;

        if($isSearching) {
            $jobs = $jobs->paginate($perPage);
        }else{
            $jobs = $jobs->where('featured', 0)->paginate($perPage);
        }

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
            'isSearching',
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
    * Set job search filtering via session and ths get 
    * redirected to the above method which gets data 
    * via the session set here.
    *
    * @param Request $request
    *
    */
    public function set_filtering(Request $request)
    {
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

          /**
             * Order By
             *
             */
            switch ($request->order) {
                case 'created_at-desc':
                    session()->put("job-filter-order", 'created_at-desc');
                    break;
                case 'created_at-asc':
                    session()->put("job-filter-order", 'created_at-asc');
                    break;
                case 'max_salary-asc':
                    session()->put("job-filter-order", 'max_salary-asc');
                    break;
                case 'max_salary-desc':
                    session()->put("job-filter-order", 'max_salary-desc');
                    break;
                case '':
                    session()->forget("job-filter-order");
                    break;
            }

            if($request->reset_odering) {
                session()->forget("job-filter-order");
            }

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
        $this->seo()->opengraph()->addImage( ($job->image) ? asset($job->image) : asset($job->company->logo), ['height' => 300, 'width' => 300]);

        /**
        * Display job.
        */
        return view("job.vacancies.view", compact(
            "job",
            "page"
        ))->compileShortcodes();
    }

    public function perPage(Request $request, $perPage)
    {
        session(['job-per-page'=>$perPage]);
        return back();
    }
}
