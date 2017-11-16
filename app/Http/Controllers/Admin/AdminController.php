<?php

namespace App\Http\Controllers\Admin;

use App\ReportTopic;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $activeReports = ReportTopic::where('status', 'open')->exists();

        return view('admin.index', compact('activeReports'));
    }

    /**
     * Clear the cache
     *
     * @return \Illuminate\Http\Response
     */
    protected function clearCache(Cache $cache)
    {
        Cache::flush();
        alert()->success('Cache Cleared');
        return back();
    }
}
