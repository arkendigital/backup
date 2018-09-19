<?php

namespace App\Http\Controllers\Admin\Jobs;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\JobLocation;
use App\Models\JobRegion;

class JobLocationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $locations = JobLocation::all();
        return view('admin.jobs.locations.index')->with(compact('locations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $regions = JobRegion::all();
        return view('admin.jobs.locations.create', compact('regions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'region_id' => 'required'
        ]);

        $location = new JobLocation();
        $location->name = $request->name;
        $location->region_id = $request->region_id;
        $location->save();

        alert()->success("Job Location has been created");

        return redirect(route('jobs.locations.edit', $location));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(JobLocation $location)
    {
        return redirect(route('jobs.locations.edit'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(JobLocation $location)
    {
        return view('admin.jobs.locations.edit')->with(compact('location'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, JobLocation $location)
    {
        $request->validate([
            'name' => 'required'
        ]);

        $location->name = $request->name;
        $location->save();

        alert()->success("Job Location has been updated");

        return redirect(route('jobs.locations.edit', $location));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(JobLocation $location)
    {
        $location->delete();

        alert()->success("Job Location has been deleted");

        return redirect(route('jobs.locations'));
    }
}
