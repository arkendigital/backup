<?php

namespace App\Http\Controllers\Admin\Employers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\AWS\ImageController as AWS;

/**
* Load modules.
*
*/
use App\Models\Employer;

/**
* Load requests.
*
*/
use App\Http\Requests\Employer as EmployerRequest;

class EmployerController extends Controller
{

  /**
  * Show a full list of employers.
  *
  */
    public function index()
    {

    /**
    * Gather list.
    *
    */
        $employers = Employer::all();

        /**
        * Display results.
        *
        */
        return view("admin.employers.index", compact(
            "employers"
        ));
    }

    /**
    * Show page for creating a new employer.
    *
    */
    public function create()
    {
        return view("admin.employers.create");
    }

    /**
    * Create a new employer in database storage.
    *
    * @param EmployerRequest $request
    *
    */
    public function store(EmployerRequest $request)
    {

    /**
    * Store new employer.
    *
    */
        $employer = Employer::create([
            "name" => request()->name,
            "link" => request()->link,
            "email" => request()->email,
            "description" => request()->description
        ]);

        /**
        * Upload crest / icon.
        *
        */
        if (request()->file("icon")) {
            $logo_path = AWS::uploadImage(
                request()->file("icon"),
                "employers"
            );

            $employer->update([
                "logo_path" => $logo_path
            ]);
        }

        /**
        * Redirect to the edit page.
        *
        */
        return redirect(route("employers.edit", compact(
            "employer"
        )));
    }

    /**
    * Show form for editing an employer.
    *
    * @param Employer $employer
    *
    */
    public function edit(Employer $employer)
    {
        return view("admin.employers.edit", compact(
            "employer"
        ));
    }

    /**
    * Update an employer in database storage.
    *
    * @param Employer $employer
    * @param EmployerRequest $request
    *
    */
    public function update(Employer $employer, EmployerRequest $request)
    {

    /**
    * Update employer.
    *
    */
        $employer->update([
           "name" => request()->name,
            "link" => request()->link,
            "email" => request()->email,
            "description" => request()->description
        ]);

        /**
        * Upload crest / icon.
        *
        */
        if (request()->file("icon")) {
            $logo_path = AWS::uploadImage(
                request()->file("icon"),
                "employers",
                $employer->logo_path
            );

            $employer->update([
                "logo_path" => $logo_path
            ]);
        }

        /**
        * Redirect to the edit page.
        *
        */
        return redirect(route("employers.edit", compact(
            "employer"
        )));
    }


    /**
    * Delete specific employer.
    *
    * @param Employer $employer
    *
    */
    public function destroy(Employer $employer)
    {

    /**
    * Delete it.
    *
    */
        $employer->delete();

        /**
        * Notify.
        *
        */
        alert("Employer has been deleted")->persistent();

        /**
        * Redirect to the list.
        *
        */
        return redirect(route("employers.index"));
    }
}
