<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function __construct()
    {
        $this->middleware(['role:Super Administrator|permission:view settings|edit settings']);
    }

    /**
     * Show an index of the settings stored in the database.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $settings = Setting::all();

        return view('admin.settings.index', compact('settings'));
    }

    /**
     * Update a record in the settings table.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        foreach ($request->all() as $key => $value) {
            if (($key == '_token') || ($key == '_method')) {
                continue;
            }

            if ($value === null) {
                $value = '';
            }

            Setting::set($key, $value);
        }

        alert()->success('Settings updated.');

        return back();
    }
}
