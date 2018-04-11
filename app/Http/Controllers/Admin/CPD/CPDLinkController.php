<?php

namespace App\Http\Controllers\Admin\CPD;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\AWS\ImageController as AWS;

use App\Http\Requests\CPDLink as CPDLinkRequest;

use App\Models\CPD\Link;

class CPDLinkController extends Controller
{

  /**
  * Display list of useful links.
  *
  */
    public function index()
    {

    /**
    * Get links.
    *
    */
        $links = Link::all();

        /**
        * Display results.
        */
        return view("admin.cpd.links.index", compact(
            "links"
        ));
    }

    /**
    * Show form for creating a new link.
    *
    */
    public function create()
    {
        return view("admin.cpd.links.create");
    }

    /**
    * Create a new link in database storage.
    *
    * @param CPDLinkRequest $request
    *
    */
    public function store(CPDLinkRequest $request)
    {

    /**
    * Add into storage.
    */
        $link = Link::create([
            "name" => request()->name,
            "link" => request()->link
        ]);

        /**
        * Redirect to edit page.
        */
        return redirect(route("cpd-links.edit", compact(
            "link"
        )));
    }

    /**
    * Show form for editing a link
    *
    * @param Link $link
    *
    */
    public function edit(Link $link)
    {
        return view("admin.cpd.links.edit", compact(
            "link"
        ));
    }

    /**
    * Update specified link in database storage.
    *
    * @param Link $link
    * @param CPDLinkRequest $request
    *
    */
    public function update(Link $link, CPDLinkRequest $request)
    {

    /**
    * Update link in storage.
    */
        $link->update([
            "name" => request()->name,
            "link" => request()->link
        ]);

        /**
        * Redirect to edit page.
        */
        return redirect()->back();
    }
}
