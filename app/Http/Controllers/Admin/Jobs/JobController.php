<?php
namespace App\Http\Controllers\Admin\Jobs;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Job as JobRequest;

use App\Models\Job;
use App\Models\JobLocation;
use App\Models\JobRegion;
use App\Models\JobCompany;

class JobController extends Controller
{

  /**
  * List jobs.
  */
    public function index()
    {

    /**
    * Get jobs.
    */
        $jobs = Job::all();

        /**
        * Display results.
        */
        return view("admin.jobs.index", compact(
            "jobs"
        ));
    }

    /**
    * Show form for editing specified job.
    *
    * @param Job $job
    *
    */
    public function edit(Job $job)
    {

    /**
    * Get list of locations.
    */
        $locations = JobLocation::all();

        /**
        * Get list of companies.
        */
        $companies = JobCompany::all();

        /**
        * Display form / page.
        */
        return view("admin.jobs.edit", compact(
            "job",
            "locations",
            "companies"
        ));
    }

    /**
    * Update specified job in database storage.
    *
    * @param Job $job
    * @param Request $request
    *
    */
    public function update(Job $job, Request $request)
    {

        /**
         * Get the region of a location
         *
         */
        $location = JobLocation::find(request()->location_id);
        $region = JobRegion::find($location->region_id);

        /**
        * Update job.
        */
        $job->update([
            "title" => request()->title,
            "excerpt" => request()->excerpt,
            "content" => request()->content,
            "salary" => request()->salary,
            "location_id" => request()->location_id,
            "region_id" => $region->id,
            "company_id" => request()->company_id,
            "apply_link" => request()->apply_link,
            "featured" => request()->featured
        ]);

        /**
        * Redirect back to edit page.
        */
        return redirect()->back();
    }

    /**
    * Show form for creating a new job.
    */
    public function create()
    {

    /**
    * Get list of locations.
    */
        $locations = JobLocation::all();

        /**
        * Get list of companies.
        */
        $companies = JobCompany::all();

        return view("admin.jobs.create", compact(
            "locations",
            "companies"
        ));
    }

    /**
    * Store new job in database storage.
    *
    * @param JobRequest $request
    *
    */
    public function store(JobRequest $request)
    {

        /**
         * Get the region of a location
         *
         */
        $location = JobLocation::find(request()->location_id);
        $region = JobRegion::find($location->region_id);

    /**
    * Create job.
    */
        $job = Job::create([
            "title" => request()->title,
            "excerpt" => request()->excerpt,
            "content" => request()->content,
            "salary" => request()->salary,
            "location_id" => request()->location_id,
            "region_id" => $region->id,
            "company_id" => request()->company_id,
            "apply_link" => request()->apply_link,
            "featured" => request()->featured
        ]);

        /**
        * Redirect to edit page.
        */
        return redirect(route("jobs.edit", compact(
            "job"
        )));
    }
}
