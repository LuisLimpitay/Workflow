<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Course;
use App\Models\Place;
use App\Models\Teacher;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $courses = Course::with(['teachers', 'categories'])->get();
        //dump($courses);
        return view ('admin.courses.index', compact ('courses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $teachers = Teacher::pluck('name', 'id');
        $categories = Category::pluck('name', 'id');
        $courses = Course::all();

        return view ('admin.courses.create', compact(
            'courses',
            'teachers',
            'categories'));

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
            'slug' => '',
            'description' => 'required',
            'content' => 'required',
            'price' => 'required',
            'category_id' => 'required',
            'teacher_id' => 'required',

        ]);
        $courses = Course::create($request->all());

        return redirect()->route('admin.courses.index', $courses)->with('info', 'Curso agregado con exito !!!');;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Course $course)
    {
        return view('courses.show', compact('course'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Course $course)
    {

        $teachers = Teacher::pluck('name', 'id');
        $categories = Category::pluck('name', 'id');

        return view ('admin.courses.edit', compact(
                                                    'course',
                                            'teachers',
                                    'categories'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


    public function update(Request $request, Course $course)
    {
        $course->update($request->all());
        return redirect()->route('admin.courses.index', $course)->with('info', 'Curso actualizado con exito !!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Course $course)
    {
        $course->delete();
        return redirect()->route('admin.courses.index')->with('info', 'Curso eliminado con exito !!!');;
    }
}

