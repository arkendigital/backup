<?php

namespace App\Http\Controllers\Admin;

use App\UrlMenu;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    /**
     * Show an index of pages.
     *
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $menus = UrlMenu::get();
        return view('admin.menus.index', compact('menus'));
    }
}