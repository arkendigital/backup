<?php
namespace App\Http\Controllers\Admin\Discussions;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\DiscussionCategory;
use App\Models\DiscussionIcon;

class DiscussionCategoryController extends Controller
{

  /**
  * Display a list of discussion categories
  */
    public function index()
    {

    /**
    * Get categories.
    */
        $categories = DiscussionCategory::all();

        /**
        * Display results.
        */
        return view("admin.discussions.categories.index", compact(
      "categories"
    ));
    }

    /**
    * Display form for creating a new category.
    */
    public function create()
    {

    /**
    * Get a list of categories.
    */
        $categories = DiscussionCategory::all();

        /**
        * Display the form.
        */
        return view("admin.discussions.categories.create", compact(
      "categories"
    ));
    }

    /**
    * Insert a new category into database storage.
    *
    * @param Request $request
    *
    */
    public function store(Request $request)
    {

    /**
    * Insert into storage.
    */
        $category = DiscussionCategory::create([
      "name" => request()->name,
      "parent_id" => request()->parent_id,
      "icon_id" => request()->icon_id
    ]);

        /**
        * Redirect to edit page.
        */
        return redirect(route("discussion-categories.edit", compact("category")));
    }

    /**
    * Display form for editing a category.
    *
    * @param DiscussionCategory $category
    *
    */
    public function edit(DiscussionCategory $category)
    {

    /**
    * Get a list of categories.
    */
        $categories = DiscussionCategory::all();

        /**
        * Get icons.
        */
        $icons = DiscussionIcon::all();

        /**
        * Display the form.
        */
        return view("admin.discussions.categories.edit", compact(
      "category",
      "categories",
      "icons"
    ));
    }

    /**
    * Update category in database storage.
    *
    * @param DiscussionCategory $category
    * @param Request $request
    *
    */
    public function update(DiscussionCategory $category, Request $request)
    {

    /**
    * Update category.
    */
        $category->update([
      "name" => request()->name,
      "parent_id" => request()->parent_id,
      "icon_id" => request()->icon_id
    ]);

        /**
        * Redirect user back to edit view.
        */
        return redirect()->back();
    }
}
