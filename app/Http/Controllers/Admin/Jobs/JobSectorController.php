<?php

namespace App\Http\Controllers\Admin\Jobs;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\JobSector;

class JobSectorController extends Controller
{
    /**
         * Display a listing of the resource.
         *
         * @return \Illuminate\Http\Response
         */
    public function index()
    {
        $sectors = JobSector::all();
        return view('admin.jobs.sectors.index')->with(compact('sectors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.jobs.sectors.create');
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
            'name' => 'required'
        ]);

        $sector = new JobSector();
        $sector->name = $request->name;
        $sector->save();

        alert('Job sector has been created')->persistent();

        return redirect(route('jobs.sectors.edit', $sector));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(JobSector $sector)
    {
        return redirect(route('jobs.sectors.edit'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(JobSector $sector)
    {
        return view('admin.jobs.sectors.edit')->with(compact('sector'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, JobSector $sector)
    {
        $request->validate([
            'name' => 'required'
        ]);

        $sector->name = $request->name;
        $sector->save();
                
        alert('Job sector has been edited')->persistent();

        return redirect(route('jobs.sectors.edit', $sector));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(JobSector $sector)
    {
        $sector->delete();
        
        alert('Job sector has been deleted')->persistent();

        return redirect(route('jobs.sectors'));
    }
}
