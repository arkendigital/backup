<?php
namespace App\Http\Controllers\Admin\Jobs;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\JobCompany as JobCompanyRequest;
use App\Http\Controllers\AWS\ImageController as AWS;

use App\Models\Job;
use App\Models\JobLocation;
use App\Models\JobCompany;

class JobCompanyController extends Controller
{

  /**
  * Display a list of companies.
  */
    public function index()
    {

    /**
    * Get companies.
    */
        $companies = JobCompany::all();

        /**
        * Display results.
        */
        return view("admin.jobs.companies.index", compact(
            "companies"
        ));
    }

    /**
    * Show form for creating a new company.
    */
    public function create()
    {
        return view("admin.jobs.companies.create");
    }

    /**
    * Create new company in database storage.
    *
    * @param JobCompanyRequest $request
    *
    */
    public function store(JobCompanyRequest $request)
    {

        /**
        * Insert company to storage.
        */
        $company = JobCompany::create([
            "name" => request()->name
        ]);

        /**
        * Upload image.
        */
        if (request()->file("logo_path")) {
            $logo_path = AWS::uploadImage(
                request()->file("logo_path"),
                "companies"
            );

            $company->update([
                "logo_path" => $logo_path
            ]);
        }

        /**
        * Redirect to edit page.
        */
        return redirect(route("job-companies.edit", compact(
            "company"
        )));
    }

    /**
    * Display edit page.
    */
    public function edit(JobCompany $company)
    {
        return view("admin.jobs.companies.edit", compact(
            "company"
        ));
    }

    /**
    * Update company in database storage.
    *
    * @param JobCompany $company
    * @param JobCompanyRequest $request
    *
    */
    public function update(JobCompany $company, JobCompanyRequest $request)
    {

    /**
    * Insert company to storage.
    */
        $company->update([
            "name" => request()->name,
            "description" => request()->description
        ]);

        /**
        * Upload image.
        */
        if (request()->file("logo_path")) {
            $logo_path = AWS::uploadImage(
                request()->file("logo_path"),
                "companies"
            );

            $company->update([
                "logo_path" => $logo_path
            ]);
        }

        /**
        * Redirect to edit page.
        */
        return redirect(route("job-companies.edit", compact(
            "company"
        )));
    }
}
