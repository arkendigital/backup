<?php

namespace App\Http\Controllers\Account;

use Cache;
use Doorman;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use JamesMills\Watchable\Models\Watch;
use App\Http\Controllers\AWS\ImageController as AWS;

/**
* Load requests.
*
*/

use App\Http\Requests\Account as AccountRequest;
use App\Http\Requests\AccountPassword as AccountPasswordRequest;

class AccountController extends Controller
{

  /**
  * Display account page.
  */
    public function index()
    {

    /**
    * Show page.
    */
        return view("account.index");
    }

    /**
    * Update account in database storage.
    *
    * @param AccountRequest $request
    *
    */
    public function update(AccountRequest $request)
    {

    /**
    * Update user details.
    */
        $account = auth()->user();

        $account->update(array_merge($request->except(["_token", "_method"])));

        /**
        * Update avatar photo.
        */
        if (request()->file("image")) {
            $size = AWS::setCustomSize([200,200]);

            $image_path = AWS::uploadImage(
                request()->file("image"),
                "user",
                $account->avatar_path
            );

            $account->update([
                "avatar_path" => $image_path
            ]);
        }

        /**
        * Redirect user.
        */
        return redirect(route("account.index"))->with([
            "alert" => true,
            "alert_title" => "Success",
            "alert_message" => "Account has been updated!",
            "alert_button" => "OK"
        ]);
    }

    /**
    * Update account password.
    *
    * @param AccountPasswordRequest $request
    *
    */
    public function updatePassword(AccountPasswordRequest $request)
    {

    /**
    * Check they have entered the correct current password.
    *
    */
        if (!password_verify(request()->old_password, auth()->user()->password)) {

      /**
      * Redirect user.
      */
            return redirect(route("account.index"))->with([
                "alert" => true,
                "alert_title" => "Update Failed",
                "alert_message" => "The password you entered did not match your current password.",
                "alert_button" => "OK"
            ]);
        }

        /**
        * They have passed the checks, so let's update their password.
        *
        */
        auth()->user()->update([
            "password" =>  bcrypt(request()->new_password)
        ]);

        /**
        * Redirect user.
        */
        return redirect(route("account.index"))->with([
        "alert" => true,
        "alert_title" => "Success",
        "alert_message" => "Your password has been updated!",
        "alert_button" => "Great!"
        ]);
    }
}
