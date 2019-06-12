<?php

namespace App\Http\Controllers\Admin\Pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Page;
use App\Models\PageField;
use App\Models\PageAdvert;
use App\Models\PageWidget;
use App\Models\Section;
use App\Models\DiscussionCategory;
use App\Models\Widget;
use Illuminate\Support\Facades\DB;

class PageController extends Controller
{

    /**
     * Display a list of pages.
     */
    public function index()
    {
        $sections = Section::all();

        /**
        * Get pages not assigned a section.
        */
        $misc_pages = Page::where("section_id", null)
            ->get();

        return view("admin.pages.index", compact(
            "pages",
            "misc_pages",
            "sections"
        ));
    }

    /**
     * Show form for creating a new page.
     */
    public function create()
    {
        $sections = Section::all();

        return view("admin.pages.create", compact(
            "sections"
        ));
    }

    /**
    * Store a new page in database storage.
    *
    * @param Request $request
    */
    public function store(Request $request)
    {
        $page = Page::create([
            "name" => request()->name,
            "section_id" => request()->section_id,
            "meta_title" => request()->meta_title,
            "meta_description" => request()->meta_description
        ]);

        //add page advert and content sections
        PageField::create([
            'page_id'   =>$page->id,
            'type'      => 'string',
            'name'      => 'Page Title',
            'key'       => 'page_title',
            'value'     => ''
        ]);

        PageField::create([
            'page_id'   =>$page->id,
            'type'      => 'text',
            'name'      => 'Page Content',
            'key'       => 'page_content',
            'value'     => ''
        ]);

        PageAdvert::create([
            'page_id'   => $page->id,
            'slug'      => 'main-content'
        ]);

        alert()->success('Page Created');

        return redirect("/ops/pages/".$page->id."/edit");
    }

    /**
    * Show page edit form / page.
    *
    * @param int $page_id
    */
    public function edit($page_id)
    {
        $page = Page::find($page_id);

        $pagefields = DB::table('pages_fields')
                    ->select([
                        DB::raw('CAST(pages_fields.value AS CHAR(10000) CHARACTER SET utf8) as value'),
                        'type', 'key', 'name'
                        ])
                    ->where('page_id',$page_id)
                    ->get();

        $sections = Section::all();

        $categories = DiscussionCategory::all();

        return view("admin.pages.edit", compact(
            "sections",
            "categories",
            "page",
            "pagefields"
        ));
    }

    /**
    * Update page in database storage.
    *
    * @param int $page_id
    * @param Request $request
    */
    public function update($page_id, Request $request)
    {
        $page = Page::find($page_id);

        /**
        * Store page in storage.
        */
        $page->update([
            "name" => request()->name,
            "section_id" => request()->section_id,
            "discussion_category_id" => request()->discussion_category_id,
            "meta_title" => request()->meta_title,
            "meta_description" => request()->meta_description,
            "show_on_sitemap" => (bool) request()->show_on_sitemap
        ]);

        /**
         * We must clear the cache for the sitemap pages.
         */
        $totalSitemapPages = ceil(Page::count() / 10000);
        for ($i = 0; $i < $totalSitemapPages; $i++) {
            \Cache::forget('sitemap-pages-page-'.$i);
        }

        /**
        * If the slug has been set, update it.
        *
        */
        if (isset(request()->slug) && request()->slug != "") {
            $page->update([
                "slug" => request()->slug
            ]);
        }

        /**
        * Save custom fields.
        */

        // dd(request()->field);

        if (! empty(request()->field)) {
            foreach (request()->field as $key => $field) {
                $page_field = PageField::where("key", $key)
                    ->where("page_id", $page->id)
                    ->first();

                $page_field->update([
                    "value" => $field
                ]);
            }
        }

        /**
        * Save adverts.
        */
        if (!empty(request()->adverts)) {
            foreach (request()->adverts as $page_advert_id => $advert_id) {
                $page_advert = PageAdvert::find($page_advert_id);

                $page_advert->update([
                    "advert_id" => $advert_id
                ]);
            }
        }

        /**
        * Save widget preferences.
        *
        */
        if (!empty(request()->widgets)) {
            $page_widgets = PageWidget::where("page_id", $page->id)
                ->get();

            foreach (request()->widgets as $widget_id => $visible) {
                foreach ($page_widgets as $widget) {
                    if (in_array($widget->id, request()->widgets)) {
                        $widget->update([
                            "is_visible" => 1
                        ]);
                    } else {
                        $widget->update([
                            "is_visible" => 0
                        ]);
                    }
                }
            }
        } else {
            PageWidget::where("page_id", $page->id)
                ->update(["is_visible" => 0]);
        }


        alert()->success('Page Updated');

        /**
        * Redirect to page edit form.
        */
        return redirect("/ops/pages/".$page->id."/edit");
    }

    /**
    * Display page for adding a new widget to the page.
    *
    * @param int $id
    *
    */
    public function addWidget($id)
    {
        $page = Page::find($id);

        $ids = PageWidget::where("page_id", $page->id)
            ->get()
            ->pluck("widget_id")
            ->toArray();

        $widgets = Widget::whereNotIn("id", $ids)
            ->get();

        return view("admin.pages.widgets.add-to-page", compact(
            "page",
            "widgets"
        ));
    }

    /**
    * Insert a widget onto a page.
    *
    */
    public function insertWidget($id, Request $request)
    {
        $widget = PageWidget::create([
            "page_id" => request()->page_id,
            "widget_id" => request()->widget_id,
            "is_visible" => 0,
        ]);

        return redirect(route("pages.edit", request()->page_id));
    }

    /**
     * Delete page
     *
     * @param int $id
     *
     */
    public function destroy($id)
    {

      /**
       * Get the page
       *
       */
        $page = Page::find($id);

        /**
         * Delete any pages widgets
         *
         */
        PageWidget::where("page_id", $page->id)
        ->delete();

        /**
         * Delete the page
         *
         */
        $page->delete();

        alert()->success("Page Deleted");

        return redirect()
        ->back();
    }

    /**
     *
     * Upload image coming from WUSIWUG
     *
     */
    public function imageUpload(Request $request, $pageId)
    {
        $path = $request->image->storeAs('pages/'.$pageId,$request->image->getClientOriginalName(), 'public'); 
        return ['success'=>true,'url'=>asset('storage/'.$path)];
    }
    
}
