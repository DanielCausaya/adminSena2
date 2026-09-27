<?php

 namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index()
    {
        return Course::all();
    }

    public function show(Course $course)
    {
        return response()->json($course, 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'duration' => 'required|string|max:50'
        ]);

        $course = Course::create($request->all());
        return response()->json($course, 201);
    }

    public function update(Request $request, Course $course)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'duration' => 'required|string|max:50'
        ]);

        $course->update($request->all());
        return response()->json($course, 200);
    }

    public function destroy(Course $course)
    {
        $course->delete();
        return response()->json(['message' => 'Curso eliminado correctamente'], 200);
    }
}