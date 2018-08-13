<?php

namespace App\Http\Controllers\Misc;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\SuggestFeature as SuggestFeatureRequest;
use App\Models\Page;
use App\Jobs\SendSuggestFeatureEmail;

class SuggestFeatureController extends Controller
{

    /**
     * Display the feature form
     *
     */
    public function index()
    {
        $page = Page::where("slug", "suggest-a-feature")
            ->first();

        /**
         * Set SEO
         *
         */
        if (isset($page->meta_title)) {
            $this->seo()->setTitle($page->meta_title);
        }

        if (isset($page->meta_description)) {
            $this->seo()->setDescription($page->meta_description);
        }

        return view("misc.suggest-feature", compact(
            "page"
        ))->compileShortcodes();
    }

    /**
     * Handle the submission of the form
     *
     * @param SuggestFeatureRequest $request
     *
     */
    public function submit(SuggestFeatureRequest $request)
    {

        /**
         * Build submission object.
         *
         */
        $submission = collect();
        $submission->name = request()->name;
        $submission->message = request()->message;
        $submission->url = request()->url;

        /**
        * Initiate the send contact email job.
        *
        */
        dispatch(new SendSuggestFeatureEmail($submission));

        /**
         * Redirect user and show a lovely front end popup notifying them
         */
        return redirect(url("/"))->with([
            "alert" => true,
            "alert_title" => "Feature Suggested",
            "alert_message" => "Thanks! Your new feature idea has been sent to us",
            "alert_button" => "Great!"
        ]);
    }
}
