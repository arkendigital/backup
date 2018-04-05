<?php

namespace App\Http\Controllers\Admin\Societies;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\AWS\ImageController as AWS;
use App\Http\Controllers\Location\LocationController as Location;

/**
* Load modules.
*
*/
use App\Models\Society;

/**
* Load requests.
*
*/
use App\Http\Requests\Society as SocietyRequest;

class SocietyController extends Controller
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
        $societies = Society::all();

        /**
        * Display results.
        *
        */
        return view("admin.societies.index", compact(
      "societies"
    ));
    }

    /**
    * Display form for creating a new society.
    *
    */
    public function create()
    {
        return view("admin.societies.create");
    }

    /**
    * Create a new society in database storage.
    *
    * @param SocietyRequest $request
    *
    */
    public function store(SocietyRequest $request)
    {

    /**
    * Get location information.
    *
    */
        $location = Location::fromPostcode(request()->postcode);

        /**
        * Insert new society.
        *
        */
        $society = Society::create([
      "name" => request()->name,
      "email" => request()->email,
      "link" => request()->link,
      "postcode" => request()->postcode,
      "description" => request()->description,
      "longitude" => $location->longitude,
      "latitude" => $location->latitude,
      "city" => $location->admin_district
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
        "societies/logos"
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
        * Upload society image.
        *
        */
        if (request()->file("image")) {

      /**
      * Upload to S3.
      *
      */
            $image_path = AWS::uploadImage(
        request()->file("image"),
        "societies/images"
      );

            /**
            * Add path for image.
            *
            */
            $society->update([
        "image_path" => $image_path
      ]);
        }

        /**
        * Redirect to edit page.
        *
        */
        return redirect(route("societies.edit", compact(
      "society"
    )));
    }

    /**
    * Display form for editing a society.
    *
    * @param Society $society
    *
    */
    public function edit(Society $society)
    {
        return view("admin.societies.edit", compact(
      "society"
    ));
    }

    /**
    * Update society in database storage.
    *
    * @param SocietyRequest $request
    * @param Society $society
    *
    */
    public function update(SocietyRequest $request, Society $society)
    {

    /**
    * Get location information.
    *
    */
        $location = Location::fromPostcode(request()->postcode);

        /**
        * Update society.
        *
        */
        $society->update([
      "name" => request()->name,
      "email" => request()->email,
      "link" => request()->link,
      "postcode" => request()->postcode,
      "description" => request()->description,
      "longitude" => $location->longitude,
      "latitude" => $location->latitude,
      "city" => $location->admin_district
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
        "societies/logos",
        $society->logo_path
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
        * Upload society image.
        *
        */
        if (request()->file("image")) {

      /**
      * Upload to S3.
      *
      */
            $image_path = AWS::uploadImage(
        request()->file("image"),
        "societies/images",
        $society->image_path
      );

            /**
            * Add path for image.
            *
            */
            $society->update([
        "image_path" => $image_path
      ]);
        }

        /**
        * Redirect to edit page.
        *
        */
        return redirect(route("societies.edit", compact(
      "society"
    )));
    }


    /**
    * Delete specific society.
    *
    * @param Society $society
    *
    */
    public function destroy(Society $society)
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
        alert("Society has been deleted")->persistent();

        /**
        * Redirect to the list.
        *
        */
        return redirect(route("societies.index"));
    }
}
