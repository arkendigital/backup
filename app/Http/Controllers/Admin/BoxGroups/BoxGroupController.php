<?php

namespace App\Http\Controllers\Admin\BoxGroups;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\AWS\ImageController as AWS;

/**
* Load models.
*
*/
use App\Models\BoxGroup;
use App\Models\BoxItem;
use App\Models\PageWidget;
use App\Models\Widget;

/**
* Load requests.
*
*/
use App\Http\Requests\BoxGroup as BoxGroupRequest;

class BoxGroupController extends Controller
{

  /**
  * Display a list of a box groups.
  *
  */
    public function index()
    {

    /**
    * Get box groups.
    *
    */
        $box_groups = BoxGroup::all();

        /**
        * List results.
        *
        */
        return view("admin.boxes.groups.index", compact(
            "box_groups"
        ));
    }

    /**
    * Display form for creating a new box group.
    *
    */
    public function create()
    {

    /**
    * Get widgets.
    *
    */
        $widgets = Widget::all();

        /**
        * Show page.
        *
        */
        return view("admin.boxes.groups.create", compact(
            "widgets"
        ));
    }

    /**
    * Create new box group in database storage.
    *
    * @param BoxGroupRequest $request
    *
    */
    public function store(BoxGroupRequest $request)
    {

    /**
    * Insert the group.
    *
    */
        $group = BoxGroup::create([
            "name" => request()->name,
            "widget_slug" => request()->widget_slug
        ]);

        /**
        * Redirect to edit page.
        *
        */
        return redirect(route("box-groups.edit", compact(
            "group"
        )));
    }

    /**
    * Display the page for editing a group.
    *
    * @param BoxGroup $group
    *
    */
    public function edit(BoxGroup $group)
    {

    /**
    * Get widgets.
    *
    */
        $widgets = Widget::all();

        /**
        * Show page.
        *
        */
        return view("admin.boxes.groups.edit", compact(
            "widgets",
            "group"
        ));
    }

    /**
    * Update a specific box group.
    *
    * @param BoxGroup $group
    * @param BoxGroupRequest $request
    *
    */
    public function update(BoxGroup $group, BoxGroupRequest $request)
    {

    /**
    * Update the group.
    *
    */
        $group->update([
            "name" => request()->name,
            "text" => request()->text,
            "widget_slug" => request()->widget_slug,
        ]);

        /**
        * Upload the image.
        *
        */
        if (request()->file("image")) {
            $image_path = AWS::uploadImage(
                request()->file("image"),
                "boxes",
                $group->image_path
            );

            $group->update([
                "image_path" => $image_path
            ]);
        }

        /**
        * Redirect to edit page.
        *
        */
        return redirect(route("box-groups.edit", compact(
            "group"
        )));
    }
}
