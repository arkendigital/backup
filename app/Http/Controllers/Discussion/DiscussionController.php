<?php

namespace App\Http\Controllers\Discussion;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Discussion as DiscussionRequest;
use App\Http\Controllers\AWS\ImageController as AWS;
use Cache;
use App\Models\Discussion;
use App\Models\DiscussionCategory;
use App\Models\DiscussionReply;

class DiscussionController extends Controller
{
    public function index(DiscussionCategory $category)
    {
        $this->seo()->setTitle("Discussion");

        $categories = $this->getCategories();

        $discussions = Discussion::with('user', 'category')
            ->withCount('replies')
            ->when(request()->search, function ($q) {
                return $q->where("name", "LIKE", "%".$_GET["search"]."%");
            })
            ->when($category->id != '', function ($q) use ($category) {
                return $q->where("category_id", $category->id);
            })
            ->orderBy("created_at", "DESC")
            ->paginate(6);


        if (isset($_GET["search"])) {
            $category = new \stdClass();
            $category->name = $_GET["search"];
        }

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
    public function view(DiscussionCategory $category, Discussion $discussion)
    {
        $this->seo()->setTitle($discussion->name);
        $this->seo()->setDescription($discussion->excerpt);

        $categories = $this->getCategories();
        $discussion->with('user', 'category', 'replies');

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
    public function store(DiscussionRequest $request)
    {

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
            "excerpt" => $excerpt,
            "content" => request()->content,
            "category_id" => request()->category_id,
            "user_id" => auth()->user()->id
        ]);

        /* Upload image if available. */
        if (request()->file("image")) {
            $image_path = AWS::uploadImage(request()->file("image"), "discussion");

            $discussion->update([
                "image_path" => $image_path
            ]);
        }

        return redirect()->back()->with([
            "alert" => true,
            "alert_title" => "Success",
            "alert_message" => "Your discussion has been created!",
            "alert_button" => "OK"
        ]);
    }

    /**
    * Show form for editing a discussion thread.
    *
    * @param DiscussionCategory $category
    * @param Discussion $discussion
    *
    */
    public function edit(DiscussionCategory $category, Discussion $discussion)
    {

        $this->seo()->setTitle("Editing '" . $discussion->name . "'");
        $this->seo()->setDescription($discussion->excerpt);

        $categories = $this->getCategories();

        $discussion->with('user', 'category');

        return view("discussion.edit", compact(
            "categories",
            "category",
            "discussion"
        ));
    }

    /**
    * Update discussion thread in database storage.
    *
    * @param DiscussionRequest $request
    * @param DiscussionCategory $category
    * @param Discussion $discussion
    *
    */
    public function update(DiscussionRequest $request, DiscussionCategory $category, Discussion $discussion)
    {

        $discussion->update([
            "name" => request()->name,
            "subject" => request()->subject,
            "content" => request()->content
        ]);


        if (request()->file("image")) {
            $image_path = AWS::uploadImage(request()->file("image"), "discussion", $discussion->image_path);

            $discussion->update([
                "image_path" => $image_path
            ]);
        }

        return redirect(route("discussion.view", compact("category", "discussion")))->with([
            "alert" => true,
            "alert_title" => "Success",
            "alert_message" => "Discussion has been updated!",
            "alert_button" => "OK"
        ]);
    }


    /**
    * Display a list of popular discussions.
    */
    public function popular()
    {
        $categories = $this->getCategories();

        // Grab the discussions, with the user and category, count the replies and order by the replies.
        $discussions = Discussion::with('user', 'category')
            ->withCount('replies')
            ->whereHas('replies')
            ->orderBy('replies_count', 'desc')
            ->paginate(6);


        $category = new \stdClass();
        $category->name = "Popular threads";

        return view("discussion.index", compact(
            "category",
            "categories",
            "discussions"
        ));
    }

    /**
    * Display a list of discussion that have replies.
    */
    public function answered()
    {
        $categories = $this->getCategories();

        $discussions = Discussion::with('user', 'category')
            ->whereHas("replies")
            ->withCount('replies')
            ->paginate(6);

        $category = new \stdClass();
        $category->name = "Answered";

        return view("discussion.index", compact(
            "category",
            "categories",
            "discussions"
        ));
    }

    /**
    * Display a list of discussion that do not have replies.
    */
    public function unanswered()
    {
        $categories = $this->getCategories();

        $discussions = Discussion::with('user', 'category')
            ->doesntHave("replies")
            ->withCount('replies')
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

    /**
     * Get the categories from the database, cache these so that we aren't messing about with constant loading.
     * Remember for 1440mins (24 hours)
     */
    protected function getCategories()
    {
        return Cache::remember('discussion_categories', 1440, function () {
            return DiscussionCategory::with('icon')->get();
        });
    }

    /**
    * Display a list of the latest discussions
    */
    public function latest()
    {
        $categories = $this->getCategories();

        $discussions = Discussion::with('user', 'category')
            ->withCount('replies')
            ->orderBy("created_at", "DESC")
            ->paginate(6);

        $category = new \stdClass();
        $category->name = "Latest Messages";

        return view("discussion.index", compact(
            "category",
            "categories",
            "discussions"
        ));
    }
}
