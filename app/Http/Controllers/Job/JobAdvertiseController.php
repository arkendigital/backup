<?php

namespace App\Http\Controllers\Job;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Jobs\SendAdvertisingEmail;
use App\Http\Requests\JobAdvertise as JobAdvertiseRequest;
use App\Models\Page;

class JobAdvertiseController extends Controller
{
    public function index()
    {

        /**
        * Get page Information
        */
        $page = Page::getPage(request()->route()->uri);

        /**
        * Set seo.
        */
        $this->seo()
          ->setTitle($page->meta_title);

        $this->seo()
          ->setDescription($page->meta_description);

        $this->seo()
            ->opengraph()->addImage($page->section->image);

        /**
        * Get adverts for this page.
        *
        */
        $page_adverts = getArrayOfAdverts($page->id);

        /**
        * Display page.
        */
        return view("job.advertise.index", compact(
            "page",
            "page_adverts"
        ))->compileShortcodes();
    }

    /**
    * Submission of the advertising form.
    *
    * @param JobAdvertiseRequest $request
    *
    */
    public function submit(JobAdvertiseRequest $request)
    {
            /**
            * Build submission object.
            *
            */
            $contact_submission = collect();
            $contact_submission->company_name = request()->company_name;
            $contact_submission->name = request()->name;
            $contact_submission->email = request()->email;
            $contact_submission->phone = request()->phone;
            $contact_submission->comment = request()->comment;
    
            /**
            * Initiate the send job advertising email job.
            *
            */
            dispatch(new SendAdvertisingEmail($contact_submission));
    
            /**
            * Redirect user.
            *
            */
            return redirect(route("index"))->with([
                "alert" => true,
                "alert_title" => "Success",
                "alert_message" => "Your message has been sent to us",
                "alert_button" => "OK"
            ]);
    }
}
