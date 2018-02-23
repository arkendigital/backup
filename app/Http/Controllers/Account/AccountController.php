<?php

namespace App\Http\Controllers\Account;

use Cache;
use Doorman;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use JamesMills\Watchable\Models\Watch;
use App\Http\Requests\Account;
use App\Http\Controllers\AWS\ImageController as AWS;

class AccountController extends Controller {

  /**
  * Display account page.
  */
  public function index() {

    /**
    * Show page.
    */
    return view("account.index");

  }

  /**
  * Update account in database storage.
  *
  * @param Account $request
  *
  */
  public function update(Account $request) {

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
    return redirect(route("account.index"))
      ->with([
        "alert" => true,
        "alert_title" => "Success",
        "alert_message" => "Account has been updated!",
        "alert_button" => "OK"
      ]);

  }

  /**
  * Update account password.
  *
  * @param AccountPassword $request
  *
  */
  public function updatePassword(AccountPassword $request) {
    dd("password");
  }
  
}
