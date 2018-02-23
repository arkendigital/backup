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


    /*
    public function index()
    {
        $this->seo()->setTitle('User Control Panel');

        $subscriptions = auth()->user()->threadsubscriptions;

        $codes = Cache::rememberForever('invites-for-'.auth()->user()->id, function() {
            if (auth()->user()->isAdmin()) {
                return Doorman::generate()->times(10)->make();
            } else {
                return Doorman::generate()->times(3)->make();
            }
        });

        return view('account.index', compact('subscriptions', 'codes'));
    }


    public function edit()
    {
        $this->seo()->setTitle('Edit Profile');

        return view('account.edit');
    }

    public function update(Request $request)
    {
        $request->validate([
            'email' => 'unique:users',
            'new_password' => 'confirmed',
        ]);

        $user = auth()->user();

        if ($request->password) {
            if (!password_verify($request->password, $user->password)) {
                alert()->error('The password you entered doesn\'t match your current password');
                return back();
            }
            alert()->success('Your password has been updated.');
            $user->update(['password' =>  bcrypt($request->new_password)]);
        }

        if ($request->email) {
            alert()->success('Your email has been updated.');
            $user->update(['email' => $request->email]);
        }

        if ($request->email && $request->password) {
            alert()->success('Your email and password have been updated.');
        }

        return back();
    }
    */

}
