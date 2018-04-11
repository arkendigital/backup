<?php

namespace App\Http\Controllers\Admin\Slides;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\AWS\ImageController as AWS;

/**
* Load models.
*
*/
use App\Models\Slide;

/**
* Load requests.
*
*/
use App\Http\Requests\Slide as SlideRequest;

class SlideController extends Controller
{

  /**
  * Display a list of slides by group.
  *
  */
    public function index()
    {

    /**
    * Get slide groups.
    *
    */
        $groups = Slide::groupBy("slug")
            ->get();

        /**
        * Display results.
        *
        */
        return view("admin.slides.index", compact(
            "groups"
        ));
    }

    /**
    * Display form for creating a new slide.
    *
    */
    public function create()
    {
        return view("admin.slides.create");
    }

    /**
    * Create a new slide in database storage.
    *
    * @param SlideRequest $request
    *
    */
    public function store(SlideRequest $request)
    {

    /**
    * Store new slide.
    *
    */
        $slide = Slide::create([
            "slug" => request()->slug,
            "title" => request()->title,
            "text" => request()->text
        ]);

        /**
        * Upload slide image.
        */
        if (request()->file("image")) {
            $image_path = AWS::uploadImage(
                request()->file("image"),
                "slides"
            );

            $slide->update([
                "image_path" => $image_path
            ]);
        }

        /**
        * Notify user.
        *
        */
        alert("Your slide has been uploaded!")->persistent();

        /**
        * Redirect to list view.
        *
        */
        return redirect(route("slides.index"));
    }

    /**
    * Show form for editing a slide.
    *
    * @param Slide $slide
    *
    */
    public function edit(Slide $slide)
    {
        return view("admin.slides.edit", compact(
            "slide"
        ));
    }

    /**
    * Update slide in database storage.
    *
    * @param Slide $slide
    * @param SlideRequest $request
    *
    */
    public function update(Slide $slide, SlideRequest $request)
    {

    /**
    * Update slide in storage.
    *
    */
        $slide->update([
            "title" => request()->title,
            "text" => request()->text
        ]);

        /**
        * Upload slide image.
        */
        if (request()->file("image")) {
            $image_path = AWS::uploadImage(
                request()->file("image"),
                "slides",
                $slide->image_path
            );

            $slide->update([
                "image_path" => $image_path
            ]);
        }

        /**
        * Notify user.
        *
        */
        alert("Your slide has been updated!")->persistent();

        /**
        * Redirect to list view.
        *
        */
        return redirect(route("slides.index"));
    }

    /**
    * Delete slide in storage.
    *
    * @param Slide $slide
    *
    */
    public function destroy(Slide $slide)
    {

    /**
    * Delete slide image.
    *
    */
        AWS::deleteImage($slide->image_path);

        /**
        * Delete the slide.
        *
        */
        $slide->delete();

        /**
        * Redirect to the slides list.
        *
        */
        return redirect(route("slides.index"));
    }
}
