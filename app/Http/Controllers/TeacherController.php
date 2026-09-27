<?php

namespace App\Http\Controllers;
 
use App\Models\Teacher;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    public function index()
    {
        return Teacher::all();
    }

    public function show(Teacher $teacher)
    {
        return response()->json($teacher, 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:teachers,email',
            'specialty' => 'required|string|max:255'
        ]);

        $teacher = Teacher::create($request->all());
        return response()->json($teacher, 201);
    }

    public function update(Request $request, Teacher $teacher)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:teachers,email,' . $teacher->id,
            'specialty' => 'required|string|max:255'
        ]);

        $teacher->update($request->all());
        return response()->json($teacher, 200);
    }

    public function destroy(Teacher $teacher)
    {
        $teacher->delete();
        return response()->json(['message' => 'Profesor eliminado correctamente'], 200);
    }
}