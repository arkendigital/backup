<?php
namespace App\Http\Controllers\Admin\Jobs;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Job as JobRequest;
use Carbon\Carbon;
use App\Models\Job;
use App\Models\JobLocation;
use App\Models\JobRegion;
use App\Models\JobCompany;
use App\Models\JobStatus;
use App\Models\JobStatus as JobType;
use App\Models\JobSector;
use App\Models\JobImpression;
use App\Models\JobUniqueImpression;
use App\Models\JobClick;

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
         * Get list of job types
         *
         */
        $types = JobType::all();

        /**
         * Get list of job sectors
         *
         */
        $sectors = JobSector::all();

        /**
        * Display form / page.
        */
        return view("admin.jobs.edit", compact(
            "job",
            "locations",
            "companies",
            "types",
            "sectors"
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
            "salary_type" => request()->salary_type,
            "salary" => request()->salary,
            "daily_salary" => request()->daily_salary,
            "location_id" => request()->location_id,
            "region_id" => $region->id,
            "company_id" => request()->company_id,
            "apply_link" => request()->apply_link,
            "featured" => request()->featured,
            "experience" => request()->experience,
            "status_id" => request()->status_id,
            "sector_id" => request()->sector_id
        ]);

        /**
         * Get recruiter info
         *
         */
        $company = JobCompany::find(request()->company_id);

        $job->update([
            "type" => $company->type
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

    /**
     * View a job
     *
     * @param Job $job
     *
     */
    public function show(Job $job, Request $request)
    {

      /**
       * Get search dates
       *
       */
        if ($request->exists("dates")) {
            $dates = explode(" - ", $request->dates);
            $start_date = $dates[0];
            $end_date = $dates[1];
        } else {
            $start_date = date("d-m-Y", strtotime(Carbon::now()->subDays(30)));
            $end_date = date("d-m-Y", strtotime(Carbon::now()));
        }

        /**
         * Get impressions for this advert
         *
         */
        $impressions = JobImpression::where("job_id", $job->id)
        ->where("created_at", ">=", date("Y-m-d", strtotime($start_date)) . " 00:00:00")
        ->where("created_at", "<=", date("Y-m-d", strtotime($end_date)) . " 23:59:59")
        ->count();

        /**
         * Get unique impressions for this advert
         *
         */
        $unique_impressions = JobUniqueImpression::where("job_id", $job->id)
        ->where("created_at", ">=", date("Y-m-d", strtotime($start_date)) . " 00:00:00")
        ->where("created_at", "<=", date("Y-m-d", strtotime($end_date)) . " 23:59:59")
        ->count();

        /**
         * Get clicks for this advert
         *
         */
        $clicks = JobClick::where("job_id", $job->id)
        ->where("created_at", ">=", date("Y-m-d", strtotime($start_date)) . " 00:00:00")
        ->where("created_at", "<=", date("Y-m-d", strtotime($end_date)) . " 23:59:59")
        ->count();

        /**
         * Click through rate
         *
         */
        if ($clicks !== 0 && $impressions !== 0) {
            $click_rate = number_format($clicks / $impressions * 100);
        } else {
            $click_rate = 0;
        }

        return view("admin.jobs.view", compact(
        "job",
        "impressions",
        "unique_impressions",
        "clicks",
        "click_rate",
        "start_date",
        "end_date"
      ));
    }
}
