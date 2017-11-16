<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\ReportTopic;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:create report|edit report|claim report|open report|close report']);
    }

    /**
     * Show an index of reports.
     *
     * @param ReportTopic $report
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ReportTopic $report)
    {
        $reports = $report->orderBy('updated_at', 'DESC')->paginate(20);

        return view('admin.reports.index', compact('reports'));
    }

    /**
     * Display a report record.
     *
     * @param ReportTopic $report
     *
     * @return \Illuminate\Http\Response
     */
    public function show(ReportTopic $report)
    {
        return view('admin.reports.show', compact('report'));
    }

    public function claim(ReportTopic $report)
    {
        if (!auth()->user()->isStaff()) {
            alert()->error('You do not have permission to do this.');
            return back();
        }

        $report->update([
            'owner_id' => auth()->user()->id,
            'status' => 'claimed'
        ]);

        alert()->success('You have claimed this report. Please be sure to update it with findings and progress.')->persistent();
        return back();
    }

    public function close(ReportTopic $report)
    {
        if (!auth()->user()->isStaff()) {
            alert()->error('You do not have permission to do this.');
            return back();
        }

        $report->update([
            'owner_id' => auth()->user()->id,
            'status' => 'closed'
        ]);

        alert()->success('You have closed this report. Please be sure to update it with your findings and actions.')->persistent();

        return back();
    }
}
