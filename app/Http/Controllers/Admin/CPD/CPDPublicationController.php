<?php

namespace App\Http\Controllers\Admin\CPD;

/**
* Load modules.
*/
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\AWS\ImageController as AWS;

/**
* Load requests.
*/
use App\Http\Requests\CPDPublication as CPDPublicationRequest;

/**
* Load models.
*/
use App\Models\CPDPublication;

class CPDPublicationController extends Controller
{

  /**
  * Display a list of current publications.
  *
  */
    public function index()
    {

    /**
    * Get publications.
    */
        $publications = CPDPublication::all();

        /**
        * Display results.
        */
        return view("admin.cpd.publications.index", compact(
      "publications"
    ));
    }

    /**
    * Display page for creating a new publication.
    *
    */
    public function create()
    {
        return view("admin.cpd.publications.create");
    }

    /**
    * Create new publication in database storage.
    *
    * @param CPDPublicationRequest $request
    *
    */
    public function store(CPDPublicationRequest $request)
    {

    /**
    * Insert into database.
    */
        $publication = CPDPublication::create([
      "name" => request()->name,
      "link" => request()->link
    ]);

        /**
        * Redirect to publications index.
        *
        */
        return redirect(route("cpd-publications.index"));
    }

    /**
    * Display page for editting a specific publication.
    *
    * @param CPDPublication $publication
    *
    */
    public function edit(CPDPublication $publication)
    {
        return view("admin.cpd.publications.edit", compact(
      "publication"
    ));
    }

    /**
    * Upload specified publication in database.
    *
    * @param CPDPublication $publication
    * @param CPDPublicationRequest $request
    *
    */
    public function update(CPDPublication $publication, CPDPublicationRequest $request)
    {

    /**
    * Update publication in database storage.
    *
    */
        $publication->update([
      "name" => request()->name,
      "link" => request()->link
    ]);

        /**
        * Redirect to publications index.
        *
        */
        return redirect(route("cpd-publications.edit", compact(
      "publication"
    )));
    }
}
