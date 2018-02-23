<?php

namespace App\Http\Controllers\Admin\Sections;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\AWS\ImageController as AWS;

use App\Models\Section;
use App\Models\SectionField;

class SectionController extends Controller {

  /**
  * Display a list of available sections to manage.
  */
  public function index() {

    /**
    * Get sections.
    */
    $sections = Section::all();

    /**
    * Display results.
    */
    return view("admin.sections.index", compact("sections"));

  }

  /**
  * Edit a section.
  *
  * @param Section @section
  *
  */
  public function edit(Section $section) {

    /**
    * Display edit form / page.
    */
    return view("admin.sections.edit", compact("section"));

  }

  /**
  * Update the specified section.
  *
  * @param Section $section
  * @param Request $request
  *
  */
  public function update(Section $section, Request $request) {

    /**
    * Update in database storage.
    */
    $section->update(array_merge(request()->except(["_method", "_token", "image"])));

    /**
    * Upload image.
    */
    if (request()->file("image")) {
      $image_path = AWS::uploadImage(
        request()->file("image"),
        "section",
        $section->image_path
      );

      $section->update([
        "image_path" => $image_path
      ]);
    }

    /**
    * Save custom fields.
    */
    if(!empty(request()->field)) {
      foreach(request()->field as $key => $field) {
        $section_field = SectionField::where("key", $key)
          ->where("section_id", $section->id)
          ->first();

        $section_field->update([
          "value" => $field
        ]);
      }
    }

    /**
    * Redirect back
    */
    return redirect()->back();

  }

}
