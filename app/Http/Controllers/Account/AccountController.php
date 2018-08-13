<?php

namespace App\Http\Controllers\Account;

use Cache;
use Doorman;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use JamesMills\Watchable\Models\Watch;
use App\Http\Controllers\AWS\ImageController as AWS;
use App\Http\Requests\Account as AccountRequest;
use App\Http\Requests\AccountPassword as AccountPasswordRequest;
use App\Models\DiscussionReply;
use App\Models\Discussion;

class AccountController extends Controller
{

    /**
    * Display account page.
    */
    public function index()
    {
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

        $account->update(array_merge($request->except(["_token", "_method", "internal_marketing", "external_marketing"])));

        if (request()->has("internal_marketing")) {
            $account->update([
                "internal_marketing" => true
            ]);
        } else {
            $account->update([
                "internal_marketing" => false
            ]);
        }

        if (request()->has("external_marketing")) {
            $account->update([
                "external_marketing" => true
            ]);
        } else {
            $account->update([
                "external_marketing" => false
            ]);
        }

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
        return redirect(url("/account"))->with([
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

    /**
     * Delete users account
     *
     *
     */
    public function destroy()
    {
        $user = auth()->user();

        /**
         * Delete all discussion comments by this user
         *
         */
        DiscussionReply::where("user_id", $user->id)
            ->delete();

        /**
         * Delete all discussions made by this user and all of its comments
         *
         */
        $discussions = Discussion::where("user_id", $user->id)
            ->get();

        foreach ($discussions as $discussion) {
            DiscussionReply::where("discussion_id", $discussion->id)
                ->delete();

            $discussion->delete();
        }

        /**
         * Logout the user
         *
         */
        auth()->logout();

        /**
         * Finally delete the user account
         *
         */
        $user->delete();

        /**
         * Redirect user and show lovely front end popup
         *
         */
        return redirect(url("/"))->with([
            "alert" => true,
            "alert_title" => "Success",
            "alert_message" => "Your account has been deleted",
            "alert_button" => "Thanks"
        ]);
    }
}
