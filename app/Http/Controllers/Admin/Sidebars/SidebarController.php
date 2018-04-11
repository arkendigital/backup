<?php

namespace App\Http\Controllers\Admin\Sidebars;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Section;
use App\Models\SectionSidebar;
use App\Models\SectionSidebarItem;
use App\Models\Page;

use App\Http\Requests\Sidebar as SidebarRequest;

class SidebarController extends Controller
{

  /**
  * Display a list of all sidebars.
  *
  */
    public function index()
    {

    /**
    * Get sidebars.
    *
    */
        $sidebars = SectionSidebar::all();

        /**
        * Display results.
        *
        */
        return view("admin.sidebars.index", compact(
            "sidebars"
        ));
    }

    /**
    * Display form for creating a new sidebar.
    *
    */
    public function create()
    {

    /**
    * Get a list of sections.
    *
    */
        $sections = Section::all();

        /**
        * Get a list of misc pages.
        *
        */
        $misc_pages = Page::where("section_id", "")
            ->get();

        /**
        * Display page.
        *
        */
        return view("admin.sidebars.create", compact(
            "sections",
            "misc_pages"
        ));
    }

    /**
    * Create a new sidebar in database storage.
    *
    * @param SidebarRequest $request
    *
    */
    public function store(SidebarRequest $request)
    {

    /**
    * Create the sidebar.
    *
    */
        $sidebar = SectionSidebar::create([
            "name" => request()->name,
            "slug" => str_slug(request()->name)
        ]);

        /**
        * Redirect to the edit page.
        *
        */
        return redirect(route("sidebars.edit", compact(
            "sidebar"
        )));
    }

    /**
    * Display page for editing a sidebar.
    *
    * @param SectionSidebar $sidebar
    *
    */
    public function edit(SectionSidebar $sidebar)
    {

    /**
    * Get a list of sections.
    *
    */
        $sections = Section::all();

        /**
        * Get a list of misc pages.
        *
        */
        $misc_pages = Page::where("section_id", "")
            ->get();

        /**
        * Display page.
        *
        */
        return view("admin.sidebars.edit", compact(
            "sections",
            "misc_pages",
            "sidebar",
            "current_pages_ids"
        ));
    }

    /**
    * Update specific sidebar in database storage.
    *
    * @param SectionSidebar $sidebar
    * @param SidebarRequest $request
    *
    */
    public function update(SectionSidebar $sidebar, SidebarRequest $request)
    {

    /**
    * Update the sidebar.
    *
    */
        $sidebar->update([
            "name" => request()->name
        ]);

        /**
        * Redirect to the edit page.
        *
        */
        return redirect(route("sidebars.edit", compact(
            "sidebar"
        )));
    }
}
