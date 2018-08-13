<?php

namespace App\Http\Controllers\Admin\Adverts;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\AWS\ImageController as AWS;
use App\Http\Requests\Advert as AdvertRequest;
use App\Models\Advert;
use App\Models\AdvertImpression;
use App\Models\AdvertUniqueImpression;
use App\Models\AdvertClick;
use Carbon\Carbon;

class AdvertController extends Controller
{
    /**
     * Display a list of all current adverts.
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        // Get adverts.
        $adverts = Advert::all();

        // Display results.
        return view("admin.adverts.index", compact(
            "adverts"
        ));
    }

    /**
     * Show form for creating a new advert
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view("admin.adverts.create");
    }

    /**
     * Insert new advert into database storage.
     * @param AdvertRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(AdvertRequest $request)
    {
        // Insert into database.
        $advert = Advert::create([
            "name" => request()->name,
            "url" => request()->url
        ]);

        // Upload advert image.
        if (request()->file("image")) {
            $image_path = AWS::uploadImage(
                request()->file("image"),
                "adverts"
            );

            $advert->update([
                "image_path" => $image_path
            ]);
        }

        // Redirect user to edit page.
        return redirect(route("adverts.edit", compact(
            "advert"
        )));
    }

    /**
     * Show form for editing advert.
     * @param Advert $advert
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Advert $advert)
    {
        return view("admin.adverts.edit", compact(
            "advert"
        ));
    }

    /**
     * Update specific advert
     *
     * @param Advert $advert
     * @param AdvertRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Advert $advert, AdvertRequest $request)
    {
        if (null !== $request->start_date) {
            $start_date = Carbon::parse(date("Y-m-d", strtotime($request->start_date)))->toDateTimeString();
        } else {
            $start_date = null;
        }

        if (null !== $request->end_date) {
            $end_date = Carbon::parse(date("Y-m-d", strtotime($request->end_date)))->toDateTimeString();
        } else {
            $end_date = null;
        }

        if ($request->exists("active")) {
            $active = true;
        } else {
            $active = false;
        }

        // Update advert
        $advert->update([
            "name" => request()->name,
            "url" => request()->url,
            "type" => request()->type,
            "tenancy_price" => request()->tenancy_price,
            "cpc" => request()->cpc,
            "start_date" => $start_date,
            "end_date" => $end_date,
            "active" => $active
        ]);

        // Upload advert image.
        if (request()->file("image")) {
            $image_path = AWS::uploadImage(
                request()->file("image"),
                "adverts",
                $advert->image_path
            );

            $advert->update([
                "image_path" => $image_path
            ]);
        }

        // Redirect user to edit page.
        return redirect()->back();
    }

    /**
     * View an advert
     *
     * @param Advert $advert
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Advert $advert, Request $request)
    {
        // Get search dates
        if ($request->exists("dates")) {
            $dates = explode(" - ", $request->dates);
            $start_date = $dates[0];
            $end_date = $dates[1];
        } else {
            $start_date = date("d-m-Y", strtotime(Carbon::now()->subDays(30)));
            $end_date = date("d-m-Y", strtotime(Carbon::now()));
        }

         // Get impressions for this advert
        $impressions = AdvertImpression::where("advert_id", $advert->id)
        ->where("created_at", ">=", date("Y-m-d", strtotime($start_date)) . " 00:00:00")
        ->where("created_at", "<=", date("Y-m-d", strtotime($end_date)) . " 23:59:59")
        ->count();

         // Get unique impressions for this advert
        $unique_impressions = AdvertUniqueImpression::where("advert_id", $advert->id)
        ->where("created_at", ">=", date("Y-m-d", strtotime($start_date)) . " 00:00:00")
        ->where("created_at", "<=", date("Y-m-d", strtotime($end_date)) . " 23:59:59")
        ->count();

         // Get clicks for this advert
        $clicks = AdvertClick::where("advert_id", $advert->id)
        ->where("created_at", ">=", date("Y-m-d", strtotime($start_date)) . " 00:00:00")
        ->where("created_at", "<=", date("Y-m-d", strtotime($end_date)) . " 23:59:59")
        ->count();

         // Click through rate
        if ($clicks !== 0 && $impressions !== 0) {
            $click_rate = number_format($clicks / $impressions * 100);
        } else {
            $click_rate = 0;
        }

        return view("admin.adverts.view", compact(
        "advert",
        "impressions",
        "unique_impressions",
        "clicks",
        "click_rate",
        "start_date",
        "end_date"
      ));
    }
}
