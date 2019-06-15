<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Widget as WidgetRequest;
use App\Models\Page;
use App\Models\Widget;
use Illuminate\Http\Request;

class WidgetController extends Controller
{
    public function index()
    {
        //get all widgets
        $widgets = Widget::all();

        return view("admin.widgets.index", compact(
            "widgets"
        ));

    }

    public function create()
    {
        return view("admin.widgets.create");
    }

    public function store(WidgetRequest $request)
    {
        $widget = Widget::create([
            'name'=>$request->name,
            'slug'=>$request->slug
        ]);

        return redirect(route("widgets.edit", compact(
            "widget"
        )));
    }

    public function edit(Widget $widget)
    {
        return view("admin.widgets.edit", compact('widget'));
    }

    public function update(Widget $widget, WidgetRequest $request)
    {
        $widget->update([
            "name" => request()->name,
            "slug" => request()->slug,
        ]);

        return redirect(route("widgets.edit", compact(
            "widget"
        )));
    }

    /**
     * Delete page
     *
     * @param int $id
     *
     */
    public function destroy($id)
    {

        Widget::find($id)->delete();

        alert()->success("Widget Deleted");

        return redirect()
        ->back();
    }
}
