<?php

namespace App\Http\Controllers\Admin\Courses;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Http\Requests\Course as CourseRequest;

class CourseController extends Controller
{

  /**
  * Display a listing of all courses.
  *
  */
    public function index()
    {

    /**
    * Gather list of courses.
    *
    */
        $courses = Course::all();
        /**
        * Display results.
        *
        */
        return view("admin.courses.index", compact('courses'));
    }

    /**
    * Display form for creating a new course.
    *
    */
    public function create()
    {
        return view("admin.courses.create");
    }

    /**
    * Store a new course in database storage.
    *
    * @param CourseRequest $request
    *
    */
    public function store(CourseRequest $request)
    {

    /**
    * Insert course.
    *
    */
        $course = Course::create([
          "name" => request()->name,
          "description" => request()->description
        ]);


        alert()->success('Course Created');
        

        /**
        * Redirect to edit page.
        *
        */
        return redirect(route("courses.edit", compact(
            "course"
        )));
    }

    /**
    * Display form for editing a course.
    *
    * @param Course $course
    *
    */
    public function edit(Course $course)
    {
        return view("admin.courses.edit", compact(
      "course"
    ));
    }

    /**
    * Update specified course in database storage.
    *
    * @param CourseRequest $request
    * @param Course $course
    *
    */
    public function update(CourseRequest $request, Course $course)
    {

    /**
    * Update course.
    *
    */
        $course->update([
          "name" => request()->name,
          "description" => request()->description
        ]);

        alert()->success('Course Updated');

    
        /**
        * Redirect to edit page.
        *
        */
        return redirect(route("courses.edit", compact(
      "course"
    )));
    }


    /**
    * Delete specific course.
    *
    * @param Course $course
    *
    */
    public function destroy(Course $course)
    {

    /**
    * Delete it.
    *
    */
        $course->delete();

        /**
        * Notify.
        *
        */
        alert("Course has been deleted")->persistent();

        /**
        * Redirect to the list.
        *
        */
        return redirect(route("courses.index"));
    }
}
