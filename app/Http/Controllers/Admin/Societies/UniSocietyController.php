<?php

namespace App\Http\Controllers\Admin\Societies;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\AWS\ImageController as AWS;
use App\Models\UniSociety;
use App\Http\Requests\UniSociety as UniSocietyRequest;

class UniSocietyController extends Controller
{

  /**
  * Display a list of societies.
  *
  */
    public function index()
    {

    /**
    * Gather list of societies.
    *
    */
        $societies = UniSociety::all();

        /**
        * Display results.
        *
        */
        return view("admin.uni-societies.index", compact(
            "societies"
        ));
    }

    /**
    * Display form for creating a new society.
    *
    */
    public function create()
    {
        return view("admin.uni-societies.create");
    }

    /**
    * Create a new society in database storage.
    *
    * @param UniSocietyRequest $request
    *
    */
    public function store(UniSocietyRequest $request)
    {

        /**
        * Insert new society.
        *
        */
        $society = UniSociety::create([
            "name" => request()->name,
            "link" => request()->link,
        ]);

        /**
        * Upload society logo.
        *
        */
        if (request()->file("logo")) {

                  /**
                  * Upload to S3.
                  *
                  */
            $logo_path = AWS::uploadImage(
                request()->file("logo"),
                "uni-societies/logos"
            );

            /**
            * Add path for logo.
            *
            */
            $society->update([
                "logo_path" => $logo_path
            ]);
        }

        /**
        * Redirect to edit page.
        *
        */
        return redirect(route("uni-societies.edit", compact(
            "society"
        )));
    }

    /**
    * Display form for editing a society.
    *
    * @param UniSociety $society
    *
    */
    public function edit(UniSociety $society)
    {
        return view("admin.uni-societies.edit", compact(
            "society"
        ));
    }

    /**
    * Update society in database storage.
    *
    * @param UniSocietyRequest $request
    * @param UniSociety $society
    *
    */
    public function update(UniSocietyRequest $request, UniSociety $society)
    {

        /**
        * Update society.
        *
        */
        $society->update([
            "name" => request()->name,
            "link" => request()->link,
        ]);

        /**
        * Upload society logo.
        *
        */
        if (request()->file("logo")) {
            /**
             * Upload to S3.
            */
            $logo_path = AWS::uploadImage(
                request()->file("logo"),
                "uni-societies/logos",
                $society->logo_path
            );

            /**
            * Add path for logo.
            */
            $society->update([
                "logo_path" => $logo_path
            ]);
        }

        /**
        * Redirect to edit page.
        *
        */
        return redirect(route("uni-societies.edit", compact(
            "society"
        )));
    }


    /**
    * Delete specific society.
    *
    * @param UniSociety $society
    *
    */
    public function destroy(UniSociety $society)
    {

        /**
        * Delete it.
        *
        */
        $society->delete();

        /**
        * Notify.
        *
        */
        alert("Uni Society has been deleted")
          ->persistent();

        /**
        * Redirect to the list.
        *
        */
        return redirect(route("uni-societies.index"));
    }
}
