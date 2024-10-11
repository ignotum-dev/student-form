<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Course::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'courses' => 'required|string|max:255|unique:courses,courses',
        ]);
    
        $course = Course::create($validatedData);
    
        return response()->json($course, 201); 
    }

    /**
     * Display the specified resource.
     */
    public function show(Course $course)
    {
        return response()->json($course, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Course $course)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Course $course)
    {
        // $course->delete();
        // return response()->json('Deleted Successfully');
    }
}
