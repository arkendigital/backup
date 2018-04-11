<?php

namespace App\Http\Controllers\Admin\Adverts;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\AWS\ImageController as AWS;

use App\Http\Requests\Advert as AdvertRequest;

use App\Models\Advert;

class AdvertController extends Controller
{

  /**
  * Display a list of all current adverts.
  *
  */
    public function index()
    {

    /**
    * Get adverts.
    */
        $adverts = Advert::all();

        /**
        * Display results.
        */
        return view("admin.adverts.index", compact(
            "adverts"
        ));
    }

    /**
    * Show form for creating a new advert
    *
    */
    public function create()
    {
        return view("admin.adverts.create");
    }

    /**
    * Insert new advert into database storage.
    *
    * @param AdvertRequest $request
    *
    */
    public function store(AdvertRequest $request)
    {

    /**
    * Insert into database.
    */
        $advert = Advert::create([
            "name" => request()->name,
            "url" => request()->url
        ]);

        /**
        * Upload advert image.
        */
        if (request()->file("image")) {
            $image_path = AWS::uploadImage(
                request()->file("image"),
                "adverts"
            );

            $account->update([
                "image_path" => $image_path
            ]);
        }

        /**
        * Redirect user to edit page.
        */
        return redirect(route("adverts.edit", compact(
            "advert"
        )));
    }

    /**
    * Show form for editing advert.
    *
    * @param Advert $advert
    *
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
    *
    */
    public function update(Advert $advert, AdvertRequest $request)
    {

    /**
    * Insert into database.
    */
        $advert->update([
            "name" => request()->name,
            "url" => request()->url
        ]);

        /**
        * Upload advert image.
        */
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

        /**
        * Redirect user to edit page.
        */
        return redirect()->back();
    }
}
