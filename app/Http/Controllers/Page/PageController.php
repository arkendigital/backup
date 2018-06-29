<?php

namespace App\Http\Controllers\Page;

use App\Http\Controllers\Controller;
use App\Page;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function show(Page $page)
    {
        return view('pages.show', compact('page'))->compileShortcodes();
    }
}
