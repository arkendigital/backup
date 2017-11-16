<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\ReportTopic;
use Illuminate\Http\Request;

class ReportPostController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:create report|edit report|claim report|open report|close report']);
    }

    public function store(ReportTopic $report, Request $request)
    {
        $report->posts()->create([
            'content' => $request->content,
            'user_id' => auth()->user()->id
        ]);
        alert()->success('Comment added');
        return back();
    }
}
