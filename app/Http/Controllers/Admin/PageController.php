<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Page;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:create page|edit page|delete page']);
    }

    /**
     * Show an index of pages.
     *
     * @param Page $page
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Page $page)
    {
        $pages = $page->paginate(20);

        return view('admin.pages.index', compact('pages'));
    }

    /**
     * Display a page record.
     *
     * @param Page $page
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Page $page)
    {
        return view('admin.pages.show', compact('page'));
    }

    /**
     * Display a form to create a page.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.create');
    }

    /**
     * Store a page in the database.
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Page $page)
    {
        $request->validate([
            'title' => 'required',
            'body' => 'required',
        ]);

        if ($request->image) {
            $image = 'storage/'.$request->image->store('images/pages');
        }

        $page->create([
            'title' => $request->title,
            'slug' => str_slug($request->title),
            'body' => $request->body,
            'image' => $image ?? null,
        ]);

        alert()->success($request->title.' has been created.');

        return redirect(route('pages.index'));
    }

    /**
     * Display an edit view.
     *
     * @param Page $page
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Page $page)
    {
        return view('admin.pages.edit', compact('page'));
    }

    /**
     * Update a page record.
     *
     * @param Request $request
     * @param Page    $page
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Page $page)
    {
        if ($request->image) {
            $image = 'storage/'.$request->image->store('images/pages');
        }

        $page->fill($request->only(['title', 'body']));

        $page->live = (bool) $request->live;
        $page->image = $image ?? $page->image;

        $page->save();

        alert()->success('Page Updated');

        return back();
    }

    /**
     * Delete a page record.
     *
     * @param Page $page
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Page $page)
    {
        $page->delete();
        alert()->success('Page deleted.');

        return back();
    }
}
