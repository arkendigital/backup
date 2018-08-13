<?php

namespace App\Http\Controllers\Admin\Jobs;

use App\Http\Controllers\Controller;
use App\Http\Requests\Job as JobRequest;
use App\Models\Job;
use App\Models\JobClick;
use App\Models\JobCompany;
use App\Models\JobImpression;
use App\Models\JobLocation;
use App\Models\JobRegion;
use App\Models\JobSector;
use App\Models\JobStatus as JobType;
use App\Models\JobUniqueImpression;
use Carbon\Carbon;
use Illuminate\Http\Request;

class JobController extends Controller
{

    /**
     * List jobs.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
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
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
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
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Job $job, Request $request)
    {

        /**
         * Get the region of a location
         */
        $location = JobLocation::find($request->location_id);
        $region = JobRegion::find($location->region_id);

        $sectors = implode(request()->sectors, ",") . ",";

        /**
         * Format start and end dates
         *
         */
        if (null !== $request->start_date) {
            $start_date = Carbon::parse(date("Y-m-d", strtotime($request->start_date)))->toDateTimeString();
        } else {
            $start_date = null;
        }

        if (null !== $request->end_date) {
            $end_date = Carbon::parse(date("Y-m-d", strtotime($request->end_date)))->toDateTimeString();
        } else {
            $end_date = null;
        }

        /**
         * Update job.
         */
        $job->update([
            "title" => request()->title,
            "excerpt" => request()->excerpt,
            "content" => request()->content,
            "salary_type" => request()->salary_type,
            "min_salary" => request()->min_salary,
            "max_salary" => request()->max_salary,
            "min_daily_salary" => request()->min_daily_salary,
            "max_daily_salary" => request()->max_daily_salary,
            "location_id" => request()->location_id,
            "region_id" => $region->id,
            "company_id" => request()->company_id,
            "apply_link" => request()->apply_link,
            "featured" => request()->featured,
            "experience" => request()->experience,
            "status_id" => request()->status_id,
            "sectors" => $sectors,
            "price" => request()->price,
  			"start_date" => $start_date,
  			"end_date" => $end_date
        ]);

        /**
         * Get recruiter info
         */
        $company = JobCompany::find($request->company_id);

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
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
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
        return view("admin.jobs.create", compact(
            "locations",
            "companies",
            "types",
            "sectors"
        ));
    }

    /**
     * Store new job in database storage.
     *
     * @param JobRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(JobRequest $request)
    {

        /**
         * Get the region of a location
         *
         */
        $location = JobLocation::find(request()->location_id);
        $region = JobRegion::find($location->region_id);

        $sectors = implode(request()->sectors, ",") . ",";

        /**
         * Format start and end dates
         *
         */
        if (null !== $request->start_date) {
            $start_date = Carbon::parse(date("Y-m-d", strtotime($request->start_date)))->toDateTimeString();
        } else {
            $start_date = null;
        }

        if (null !== $request->end_date) {
            $end_date = Carbon::parse(date("Y-m-d", strtotime($request->end_date)))->toDateTimeString();
        } else {
            $end_date = null;
        }

        /**
         * Create the job
         */
        $job = Job::create([
            "title" => request()->title,
            "excerpt" => request()->excerpt,
            "content" => request()->content,
            "salary_type" => request()->salary_type,
            "min_salary" => request()->min_salary,
            "max_salary" => request()->max_salary,
            "min_daily_salary" => request()->min_daily_salary,
            "max_daily_salary" => request()->max_daily_salary,
            "location_id" => request()->location_id,
            "region_id" => $region->id,
            "company_id" => request()->company_id,
            "apply_link" => request()->apply_link,
            "featured" => request()->featured,
            "experience" => request()->experience,
            "status_id" => request()->status_id,
            "sectors" => $sectors,
            "price" => request()->price,
  			"start_date" => $start_date,
  			"end_date" => $end_date
        ]);

        /**
         * Get and set recruiter info
         *
         */
        $company = JobCompany::find(request()->company_id);

        $job->update([
            "type" => $company->type
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
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Job $job, Request $request)
    {

        /**
         * Get search dates
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
         */
        $impressions = JobImpression::where("job_id", $job->id)
            ->where("created_at", ">=", date("Y-m-d", strtotime($start_date)) . " 00:00:00")
            ->where("created_at", "<=", date("Y-m-d", strtotime($end_date)) . " 23:59:59")
            ->count();

        /**
         * Get unique impressions for this advert
         */
        $unique_impressions = JobUniqueImpression::where("job_id", $job->id)
            ->where("created_at", ">=", date("Y-m-d", strtotime($start_date)) . " 00:00:00")
            ->where("created_at", "<=", date("Y-m-d", strtotime($end_date)) . " 23:59:59")
            ->count();

        /**
         * Get clicks for this advert
         */
        $clicks = JobClick::where("job_id", $job->id)
            ->where("created_at", ">=", date("Y-m-d", strtotime($start_date)) . " 00:00:00")
            ->where("created_at", "<=", date("Y-m-d", strtotime($end_date)) . " 23:59:59")
            ->count();

        /**
         * Click through rate
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

    /**
     * Delete a job
     *
     */
    function destroy(Job $job)
    {

        $job->delete();

        alert($job->title . " has been removed")
            ->persistent();

        return redirect()->back();

    }

}
