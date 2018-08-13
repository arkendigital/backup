<?php

namespace App\Http\Controllers\Admin\CPD;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CPDResource;
use App\Models\CPDResourceLink;
use App\Http\Requests\CPDResourceLink as CPDResourceLinkRequest;

class CPDResourceLinkController extends Controller
{

    /**
     * Show form for creating new resource link
     *
     * @param CPDResource $resource
     *
     */
    public function create(CPDResource $resource)
    {
        return view("admin.cpd.resources.links.create", compact(
            "resource"
        ));
    }

    /**
     * Add new resource link in database storage
     *
     * @param CPDResource $resource
     * @param CPDRequestLinkRequest $request
     *
     */
    public function store(CPDResource $resource, CPDResourceLinkRequest $request)
    {

        /**
         * Store link
         *
         */
        $link = CPDResourceLink::create([
            "resource_id" => $resource->id,
            "title" => $request->title,
            "subtitle" => $request->subtitle,
            "text" => $request->text,
            "link" => $request->link
        ]);

        /**
         * Redirect back to resource edit page
         *
         */
        return redirect(route("cpd-resources.edit", $resource));
    }

    /**
     * Show form for editing a resource link
     *
     * @param CPDResource $resource
     * @param CPDResourceLink $link
     *
     */
    public function edit(CPDResource $resource, CPDResourceLink $link)
    {
        return view("admin.cpd.resources.links.edit", compact(
            "resource",
            "link"
        ));
    }

    /**
     * Add new resource link in database storage
     *
     * @param CPDResource $resource
     * @param CPDResourceLink $link
     * @param CPDRequestLinkRequest $request
     *
     */
    public function update(CPDResource $resource, CPDResourceLink $link, CPDResourceLinkRequest $request)
    {

        /**
         * Store link
         *
         */
        $link->update([
            "title" => $request->title,
            "subtitle" => $request->subtitle,
            "text" => $request->text,
            "link" => $request->link
        ]);

        /**
         * Redirect back to resource edit page
         *
         */
        return redirect(route("cpd-resources.edit", $resource));
    }
}
