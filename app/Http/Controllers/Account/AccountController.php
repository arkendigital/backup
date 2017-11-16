<?php

namespace App\Http\Controllers\Account;

use Cache;
use Doorman;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use JamesMills\Watchable\Models\Watch;

class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $this->seo()->setTitle('Edit Profile');

        return view('account.edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int                      $id
     *
     * @return \Illuminate\Http\Response
     */
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
}
