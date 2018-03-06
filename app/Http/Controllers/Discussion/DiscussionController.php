<?php

namespace App\Http\Controllers\Discussion;

/**
* Load modules.
*/
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Discussion as DiscussionRequest;

/**
* Load models.
*/
use App\Models\Discussion;
use App\Models\DiscussionCategory;
use App\Models\DiscussionReply;

class DiscussionController extends Controller {

  public function index(DiscussionCategory $category) {

    /**
    * Set seo.
    */
    $this->seo()->setTitle("Discussion");

    /**
    * Get a list of categories.
    */
    $categories = DiscussionCategory::all();

    /**
    * Get a list of discussions.
    *
    * - Get if is using the search
    * - Check if user has filtered by category
    *
    */

    if (isset($_GET["search"])) {

      $discussions = Discussion::where("name", "LIKE", "%".$_GET["search"]."%")
        ->paginate(6);

      $category = new \stdClass();
      $category->name = $_GET["search"];

    } else {

      /**
      * Category filtering.
      */
      if ($category->id == "") {
        $discussions = Discussion::paginate(6);
      } else {
        $discussions = Discussion::where("category_id", $category->id)
          ->paginate(6);
      }

    }

    /**
    * Display page.
    */
    return view("discussion.index", compact(
      "category",
      "categories",
      "discussions"
    ));

  }

  /**
  * View a specific discussion.
  *
  * @param DiscussionCategory $category
  * @param Discussion $discussion
  *
  */
  public function view(DiscussionCategory $category, Discussion $discussion) {

    /**
    * Set SEO.
    */
    $this->seo()->setTitle($discussion->name);
    $this->seo()->setDescription($discussion->excerpt);

    /**
    * Get a list of categories.
    */
    $categories = DiscussionCategory::all();

    /**
    * Display the view page.
    */
    return view("discussion.view", compact(
      "categories",
      "category",
      "discussion"
    ));

  }

  /**
  * Store a new discussion in database storage.
  *
  * @param DiscussionRequest $request
  *
  */
  public function store(DiscussionRequest $request) {

    /**
    * Get excerpt for discussion.
    */
    if (isset(request()->excerpt) && request()->excerpt != "") {
      $excerpt = request()->excerpt;
    } else {
      $excerpt = substr(strip_tags(request()->content), 0, 150) . "...";
    }

    /**
    * Store new discussion in database storage
    */
    $discussion = Discussion::create([
      "name" => request()->name,
      "subject" => request()->subject,
      "excerpt" => $excerpt,
      "content" => request()->content,
      "category_id" => request()->category_id,
      "user_id" => auth()->user()->id
    ]);

    /**
    * Redirect and notify the user.
    */
    return redirect("/discussion/".$discussion->category->slug."/".$discussion->slug)
      ->with([
        "alert" => true,
        "alert_title" => "Success",
        "alert_message" => "Your discussion has been created!",
        "alert_button" => "OK"
      ]);

  }


  /**
  * Display a list of popular discussions.
  */
  public function popular() {

    /**
    * Get a list of categories.
    */
    $categories = DiscussionCategory::all();

    /**
    * Get a list of most popular discussions based on amount of replies.
    */
    $popular = DiscussionReply::select('discussion_id', \DB::raw('count(discussion_id) as count'))
      ->groupBy('discussion_id')
      ->orderBy('count','DESC')
      ->take(18)
      ->get()
      ->pluck("discussion_id");

    $ids = array_sort($popular, "count");

    /**
    * Get a list of discussions.
    */
    $discussions = Discussion::whereIn("id", $ids)
      ->paginate(6);

    /**
    * Define the category.
    */
    $category = new \stdClass();
    $category->name = "Popular threads";

    /**
    * Display page.
    */
    return view("discussion.index", compact(
      "category",
      "categories",
      "discussions"
    ));

  }

  /**
  * Display a list of discussion that have replies.
  */
  public function answered() {

    /**
    * Get a list of categories.
    */
    $categories = DiscussionCategory::all();

    /**
    * Get a list of discussions.
    */
    $discussions = Discussion::whereHas("replies")
      ->paginate(6);

    /**
    * Define the category.
    */
    $category = new \stdClass();
    $category->name = "Answered";

    /**
    * Display page.
    */
    return view("discussion.index", compact(
      "category",
      "categories",
      "discussions"
    ));


  }

  /**
  * Display a list of discussion that do not have replies.
  */
  public function unanswered() {

    /**
    * Get a list of categories.
    */
    $categories = DiscussionCategory::all();

    /**
    * Get a list of discussions.
    */
    $discussions = Discussion::doesntHave("replies")
      ->paginate(6);

    /**
    * Define the category.
    */
    $category = new \stdClass();
    $category->name = "Unanswered";

    /**
    * Display page.
    */
    return view("discussion.index", compact(
      "category",
      "categories",
      "discussions"
    ));


  }

}
