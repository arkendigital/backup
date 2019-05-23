<?php

namespace App\Http\Controllers\Discussion;

use App\Article;
use App\Http\Controllers\AWS\ImageController as AWS;
use App\Http\Controllers\Controller;
use App\Http\Requests\Discussion as DiscussionRequest;
use App\Models\Discussion;
use App\Models\DiscussionCategory;
use App\Models\DiscussionReply;
use App\Models\Page;
use Cache;
use Illuminate\Http\Request;

class DiscussionController extends Controller
{

    /**
     * Main list of discussions
     *
     * @param DiscussionCategory $category
     *
     */
    public function index(DiscussionCategory $category)
    {
        /**
         * Get page information
         *
         */
        $page = Page::getPage("discussion");

        /**
         * Set page SEO
         *
         */
        $this->seo()
          ->setTitle($page->meta_title);
        $this->seo()
          ->setDescription($page->meta_description);

        /**
         * Get adverts for this page.
         *
         */
        $page_adverts = getArrayOfAdverts($page->id);

        /**
         * Get a list of categories for the sidebar
         *
         */
        $categories = $this->getCategories();

        /**
         * Get the discussions to display
         * - If the user is searching add the search paramater to the query
         * - If the user is filtering by category, filter the results to that category
         *
         */
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


        /**
         * Set the sub title at the top of the page to the search term
         *
         */
        if (isset($_GET["search"])) {
            $category = new \stdClass();
            $category->name = $_GET["search"];
        }

        return view("discussion.index", compact(
            "page",
            "page_adverts",
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
        /**
         * Get page information
         *
         */
        $page = Page::getPage("discussion");

        /**
         * Get adverts for this page.
         *
         */
        $page_adverts = getArrayOfAdverts($page->id);

        $this->seo()->setTitle($discussion->name);
        $this->seo()->setDescription($discussion->excerpt);

        if ($discussion->image_path != "") {
            $this->seo()->opengraph()->addImage($discussion->image);
        }

        $categories = $this->getCategories();
        $discussion->with('user', 'category', 'replies');

        return view("discussion.view", compact(
            "page_adverts",
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

        /**
        * Get excerpt for discussion.
        */
        if (isset(request()->excerpt) && request()->excerpt != "") {
            $excerpt = request()->excerpt;
        } else {
            $excerpt = substr(strip_tags(request()->content), 0, 150) . "...";
        }

        $discussion->update([
            "name" => request()->name,
            "excerpt" => $excerpt,
            "content" => request()->content,
            "category_id" => request()->category_id,
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
     * Remove discussion thread from database storage
     *
     * @param DiscussionCategory $category
     * @param Discussion $discussion
     *
     */
    public function destroy(DiscussionCategory $category, Discussion $discussion)
    {

        /**
         * Remove any comments
         *
         */
        DiscussionReply::where("discussion_id", $discussion->id)
            ->delete();

        /**
         * Remove the discussion itself
         *
         */
        $discussion->delete();

        return redirect(route("front.discussion.index"))->with([
            "alert" => true,
            "alert_title" => "Success",
            "alert_message" => $discussion->name . " has been deleted!",
            "alert_button" => "OK"
        ]);
    }


    /**
     * Display a list of popular discussions
     *
     */
    public function popular()
    {
        $this->seo()->setTitle('Popular Discussions');

        /**
         * Get list of categories to display in the sidebar
         *
         */
        $categories = $this->getCategories();

        /**
         * Grab the discussions, with the user and category, count the replies and order by the replies.
         *
         */
        $discussions = Discussion::with('user', 'category')
            ->withCount('replies')
            ->whereHas('replies')
            ->orderBy('replies_count', 'desc')
            ->paginate(6);

        /**
         * Set the sub title of the page to following string
         *
         */
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
        $this->seo()->setTitle('Answered Discussions');

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

        $this->seo()->setTitle('Unanswered Discussions');
        // $this->seo()->setDescription($page->meta_description);

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
        return DiscussionCategory::with('icon')->get();
    }

    /**
    * Display a list of the latest discussions
    */
    public function latest()
    {
        $this->seo()->setTitle('Latest Discussions');

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
