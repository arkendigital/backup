<?php
namespace App\Http\Controllers\Job;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Job;

class JobTrackingController extends Controller
{

    /**
     * Track advert click
     *
     * @param Request $requet
     *
     */
    public function track(Request $request)
    {

        /**
         * Get the related advert model
         *
         */
        $job = Job::find($request->id);

        /**
         * Increment the click counter for this advert
         *
         */
        $job->trackClick();

        /**
         * Redirect user to the target url
         *
         */
        return redirect(url("/jobs/vacancies/" . $job->slug));
    }
}
