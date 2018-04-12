<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\WealthOfInformation as Wealth;

class WealthOfInformation extends Controller
{
    protected function index()
    {
        $wealth = Wealth::all();

        return view('admin.wealth-of-info.index', compact(['wealth']));
    }

    protected function edit(Wealth $wealth)
    {
        return view('admin.wealth-of-info.edit')->with(compact('wealth'));
    }

    protected function update(Request $request, Wealth $wealth)
    {
        $request->validate([
            'title' => 'required',
            'colour' => 'required'
        ]);

        $wealth->title = $request->title;
        $wealth->colour = $request->colour;
        $wealth->content = $request->content;
        $wealth->data = $request->data;
        $wealth->save();

        alert()->success('Information box updated');

        return redirect(route('wealth.edit', $wealth));
    }
}
