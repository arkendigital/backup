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

class SocietyController extends Controller {

  /**
  * Display a list of societies.
  *
  */
  public function index() {

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
  public function create() {

    return view("admin.societies.create");

  }

  /**
  * Create a new society in database storage.
  *
  * @param SocietyRequest $request
  *
  */
  public function store(SocietyRequest $request) {

    /**
    * Insert new society.
    *
    */
    $society = Society::create([
      "name" => request()->name
    ]);

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
  public function edit(Society $society) {

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
  public function update(SocietyRequest $request, Society $society) {

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
      "postcode" => request()->postcode,
      "longitude" => $location->longitude,
      "latitude" => $location->latitude,
      "city" => $location->admin_district
    ]);

    /**
    * Redirect to edit page.
    *
    */
    return redirect(route("societies.edit", compact(
      "society"
    )));

  }

}
