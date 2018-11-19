<?php

namespace App\Http\Controllers\Admin;

use App\UrlMenu;
use App\UrlMenuLink;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MenuLinkController extends Controller
{

    /**
     * Display the specified resource.
     *
     * @param  int  id
     * @return \Illuminate\Http\Response
     */
    public function create(UrlMenu $menu)
    {
        return view('admin.menus.links.create', compact('menu'));
    }

    public function edit(UrlMenuLink $link)
    {
        return view('admin.menus.links.edit', compact('link'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  request
     * @return \Illuminate\Http\Response
     */
    public function store(UrlMenu $menu)
    {
        request()->validate([
            'text' => 'required',
            'link' => 'required'
        ]);

        UrlMenuLink::create([
            'text' => request()->text,
            'link' => request()->link,
            'order' => request()->order,
            'url_menu_id' => $menu->id
        ]);

        return redirect()->route('menus.index');
    }

    /**
         * Update the specified resource in storage.
         *
         * @param  \Illuminate\Http\Request  request
         * @param  int  id
         * @return \Illuminate\Http\Response
         */
        public function update(UrlMenuLink $link)
        {
            request()->validate([
                'text' => 'required',
                'link' => 'required'
            ]);
    
            $link->update([
                'text' => request()->text,
                'link' => request()->link,
                'order' => request()->order,
            ]);
    
            return redirect()->route('menus.index');
        }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  id
     * @return \Illuminate\Http\Response
     */
    public function destroy($link)
    {
        $url = UrlMenuLink::find($link);
        $url->delete();
        alert()->success('Link deleted.');

        return back();
    }
    
}