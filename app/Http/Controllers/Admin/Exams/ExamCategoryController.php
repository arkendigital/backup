<?php

namespace App\Http\Controllers\Admin\Exams;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

/**
* Load modules.
*
*/
use App\Models\Exam\Category as ExamCategory;
use App\Models\Exam\Module as ExamModule;
use App\Models\Exam\Info as ExamModuleInfo;

/**
* Load requests.
*
*/
use App\Http\Requests\ExamCategory as ExamCategoryRequest;

class ExamCategoryController extends Controller {

  /**
  * Display a list of all exam categories.
  *
  */
  public function index() {

    /**
    * Get categories.
    *
    */
    $categories = ExamCategory::all();

    /**
    * List results.
    *
    */
    return view("admin.exams.categories.index", compact(
      "categories"
    ));

  }

  /**
  * Display form for creating a new exam category.
  *
  */
  public function create() {

    return view("admin.exams.categories.create");

  }

  /**
  * Store a new exam category in the database.
  *
  * @param ExamCategoryRequest $request
  *
  */
  public function store(ExamCategoryRequest $request) {

    /**
    * Insert category.
    *
    */
    $category = ExamCategory::create([
      "name" => request()->name,
      "slug" => str_slug(request()->name)
    ]);

    /**
    * Redirect to edit page.
    *
    */
    return redirect(route("exam-categories.edit", compact(
      "category"
    )));

  }

  /**
  * Display page for editing a category.
  *
  * @param ExamCategory $category
  *
  */
  public function edit(ExamCategory $category) {

    /**
    * Display page.
    *
    */
    return view("admin.exams.categories.edit", compact(
      "category"
    ));

  }

}
