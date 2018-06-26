<?php

namespace App\Http\Controllers\Admin\Exams;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\AWS\ImageController as AWS;

use App\Http\Requests\ExamResource as ExamResourceRequest;

use App\Models\ExamResource;

class ExamResourceController extends Controller
{

  /**
  * Display a list of exam resources.
  *
  */
    public function index()
    {

    /**
    * Get list of exam resources.
    */
        $resources = ExamResource::all();

        /**
        * Display results.
        */
        return view("admin.exams.resources.index", compact(
            "resources"
        ));
    }

    /**
    * Show form for creating a new exam resource.
    *
    */
    public function create()
    {
        return view("admin.exams.resources.create");
    }

    /**
    * Create a new exam resource in database storage.
    *
    * @param ExamResourceRequest $request
    *
    */
    public function store(ExamResourceRequest $request)
    {

    /**
    * Create new resource in storage.
    */
        $resource = ExamResource::create([
            "name" => request()->name,
            "excerpt" => request()->excerpt,
            "link" => request()->link
        ]);

        /**
        * Upload icon.
        */
        if (request()->file("icon")) {
            $icon_path = AWS::uploadImage(
                request()->file("icon"),
                "exam-resources"
            );

            $resource->update([
                "icon_path" => $icon_path
            ]);
        }

        /**
        * Redirect to edit page.
        */
        return redirect(route("exam-resources.edit", compact(
            "resource"
        )));
    }

    /**
    * Show form for editing resource.
    *
    * @param ExamResource $resource
    *
    */
    public function edit(ExamResource $resource)
    {
        return view("admin.exams.resources.edit", compact(
            "resource"
        ));
    }

    /**
    * Update specified resource in database storage.
    *
    * @param ExamResource $resource
    * @param ExamResourceRequest $request
    *
    */
    public function update(ExamResource $resource, ExamResourceRequest $request)
    {

    /**
    * Create new resource in storage.
    */
        $resource->update([
            "name" => request()->name,
            "excerpt" => request()->excerpt,
            "link" => request()->link
        ]);

        /**
        * Upload icon.
        */
        if (request()->file("icon")) {
            $icon_path = AWS::uploadImage(
                request()->file("icon"),
                "exam-resources",
                $resource->icon_path
            );

            $resource->update([
                "icon_path" => $icon_path
            ]);
        }

        /**
        * Redirect to edit page.
        */
        return redirect(route("exam-resources.edit", compact(
            "resource"
        )));
    }
}
