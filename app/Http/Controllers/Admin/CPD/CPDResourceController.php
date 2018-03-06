<?php

namespace App\Http\Controllers\Admin\CPD;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\AWS\ImageController as AWS;

use App\Http\Requests\CPDResource as CPDResourceRequest;

use App\Models\CPDResource;

class CPDResourceController extends Controller {

  /**
  * Display a list of CPD resources.
  *
  */
  public function index() {

    /**
    * Get list of cpd resources.
    */
    $resources = CPDResource::all();

    /**
    * Display results.
    */
    return view("admin.cpd.resources.index", compact(
      "resources"
    ));

  }

  /**
  * Show form for creating a new cpd resource.
  *
  */
  public function create() {

    return view("admin.cpd.resources.create");

  }

  /**
  * Create a new cpd resource in database storage.
  *
  * @param CPDResourceRequest $request
  *
  */
  public function store(CPDResourceRequest $request) {

    /**
    * Create new resource in storage.
    */
    $resource = CPDResource::create([
      "name" => request()->name,
      "excerpt" => request()->excerpt,
      "content" => request()->content
    ]);

    /**
    * Upload icon.
    */
    if (request()->file("icon")) {
      $icon_path = AWS::uploadImage(
        request()->file("icon"),
        "cpd-resources"
      );

      $resource->update([
        "icon_path" => $icon_path
      ]);
    }

    /**
    * Redirect to edit page.
    */
    return redirect(route("cpd-resources.edit", compact(
      "resource"
    )));

  }

  /**
  * Show form for editing resource.
  *
  * @param CPDResource $resource
  *
  */
  public function edit(CPDResource $resource) {

    return view("admin.cpd.resources.edit", compact(
      "resource"
    ));

  }

  /**
  * Update specified resource in database storage.
  *
  * @param CPDResource $resource
  * @param CPDResourceRequest $request
  *
  */
  public function update(CPDResource $resource, CPDResourceRequest $request) {

    /**
    * Create new resource in storage.
    */
    $resource->update([
      "name" => request()->name,
      "excerpt" => request()->excerpt,
      "content" => request()->content
    ]);

    /**
    * Upload icon.
    */
    if (request()->file("icon")) {
      $icon_path = AWS::uploadImage(
        request()->file("icon"),
        "cpd-resources",
        $resource->icon_path
      );

      $resource->update([
        "icon_path" => $icon_path
      ]);
    }

    /**
    * Redirect to edit page.
    */
    return redirect(route("cpd-resources.edit", compact(
      "resource"
    )));

  }

}
