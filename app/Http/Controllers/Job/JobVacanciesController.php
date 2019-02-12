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
    public function index(Request $request)
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
            // ->where("featured", 0)
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

        if($request->order) {
            switch ($request->order) {
                case 'created_at-desc':
                    session()->put("job-filter-order", 'created_at-desc');
                    $jobs = $jobs->orderBy('created_at', 'DESC');
                    break;
                case 'created_at-asc':
                    session()->put("job-filter-order", 'created_at-asc');
                    $jobs = $jobs->orderBy('created_at', 'ASC');
                    break;
                case 'salary-asc':
                    session()->put("job-filter-order", 'salary-asc');
                    $jobs = $jobs->orderBy('max_salary', 'ASC');
                    break;
                case 'salary-desc':
                    session()->put("job-filter-order", 'salary-desc');
                    $jobs = $jobs->orderBy('max_salary', 'DESC');
                    break;
            }
        }

        if($isSearching) {
            $jobs = $jobs->paginate(6);
        }else{
            $jobs = $jobs->where('featured', 0)->paginate(6);
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
