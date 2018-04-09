<?php

namespace App\Http\Controllers\Job;

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
use App\Models\Job;
use App\Models\JobLocation;
use App\Models\JobSector;
use App\Models\JobCompany;

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
        $jobs = Job::with('company', 'location', 'sector')->where("featured", 0);

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

        if (session()->exists("job-filter-type") && !empty(session()->get("job-filter-type"))) {
            $jobs = $jobs->whereIn("type", session()->get("job-filter-type"));
        }

        if (session()->exists('job-filter-sector') && !empty(session()->get('job-filter-sector'))) {
            $jobs = $jobs->where('sector_id', session()->get('job-filter-sector'));
        }

        if (session()->exists('job-filter-location') && !empty(session()->get('job-filter-location'))) {
            $jobs = $jobs->whereHas('location', function ($q) {
                $q->where('name', 'LIKE', '%' . session()->get('job-filter-location') . '%');
            });
        }

        if (! session()->exists('job-filter-order')) {
            session()->put("job-filter-order", 'created_at-desc');
        }

        if (session()->exists('job-filter-order') && !empty(session()->get('job-filter-order'))) {
            $order = explode('-', session()->get('job-filter-order'));
            $jobs = $jobs->orderBy($order[0], $order[1]);
        }

        $jobs = $jobs->paginate(6);

        /**
        * Display results.
        */
        return view("job.vacancies.index", compact(
            "featured_jobs",
            "jobs",
            "page",
            "section",
            'sectors'
        ));
    }

    /**
    * Set job search filtering.
    *
    * @param Request $request
    *
    */
    public function set_filtering(Request $request)
    {
        if (request()->location) {
            session()->put("job-filter-location", request()->location);
            session()->put("job-filter-order", request()->order);
        } else {
            session()->put("job-filter-keyword", request()->keyword);
            session()->put("job-filter-status", request()->status);
            session()->put("job-filter-experience", request()->experience);
            session()->put("job-filter-type", request()->type);
            session()->put("job-filter-sector", request()->sector);
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

        /**
        * Display job.
        */
        return view("job.vacancies.view", compact(
            "job",
            "page"
        ));
    }
}
