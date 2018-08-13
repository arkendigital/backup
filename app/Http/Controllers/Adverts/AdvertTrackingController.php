<?php
namespace App\Http\Controllers\Adverts;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Advert;

class AdvertTrackingController extends Controller
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
        $advert = Advert::find($request->id);

        /**
         * Increment the click counter for this advert
         *
         */
        $advert->trackClick();

        /**
         * Redirect user to the target url
         *
         */
        return redirect($request->url);
    }
}
