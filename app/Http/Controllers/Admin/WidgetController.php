<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
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

    public function store(Request $request)
    {
        
    }
	//function to show custom pages where it has to be added to routes manually
    // public function show(Page $page)
    // {
    //     return redirect()->to($page->slug);
    // }
    
    
    // private function set_seo($page)
    // {
    //     $this->seo()->setTitle($page->meta_title);
    //     $this->seo()->setDescription($page->meta_description);
    //     $this->seo()->opengraph()->addImage($page->section->image);
    // }

    // function to show auto generated pages with unified prefix
    // public function showPage($slug)
    // {
    	
    //     $page = Page::where("slug", 'actuaries/'.$slug)
    //         ->first();

    //     $this->set_seo($page);

    //     $page_adverts = getArrayOfAdverts($page->id);

    //     return view("pages.show", [
    //         "section" => $page->section,
    //         "page" => $page,
    //         "page_adverts" => $page_adverts
    //     ])->compileShortcodes();
    // }
}
