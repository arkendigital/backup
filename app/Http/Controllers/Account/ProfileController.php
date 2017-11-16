<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
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

        return view('account.profile.edit');
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
            'gender' => 'nullable|alpha_num',
            'date_birth' => 'nullable|date',
            'display_name' => 'max:30,unique:profiles,display_name,'.auth()->user()->id,
            'signature' => 'max:180'
        ]);

        if (!empty(request()->date_birth)) {
            $dateOfBirth = Carbon::parse(request()->date_birth);
        }

        $profile = auth()->user()->profile;

        $profile->update([
            'display_name' => request()->display_name,
            'about' => request()->about,
            'user_title' => request()->user_title,
            'location' => request()->location,
            'gender' => request()->gender,
            'date_birth' => $dateOfBirth ?? null,
            'social_networks' => request()->social_networks ?? null,
            'signature' => request()->signature ?? null
        ]);

        alert()->success('Profile updated!');

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
