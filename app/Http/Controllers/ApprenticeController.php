<?php

namespace App\Http\Controllers;
namespace App\Http\Controllers;

use App\Models\Apprentice;
use Illuminate\Http\Request;

class ApprenticeController extends Controller
{
     public function index()
    {
        return Apprentice::all();
    }

     public function show(Apprentice $apprentice)
    {
        return response()->json($apprentice, 200);
    }

     public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:apprentices,email',
            'cell_number' => 'required|string|max:20',
            'course_id' => 'required|exists:courses,id',
            'computer_id' => 'required|exists:computers,id'
        ]);

        $apprentice = Apprentice::create($request->all());

        return response()->json($apprentice, 201);
    }

     public function update(Request $request, Apprentice $apprentice)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:apprentices,email,' . $apprentice->id,
            'cell_number' => 'required|string|max:20',
            'course_id' => 'required|exists:courses,id',
            'computer_id' => 'required|exists:computers,id'
        ]);

        $apprentice->update($request->all());

        return response()->json($apprentice, 200);
    }

     public function destroy(Apprentice $apprentice)
    {
        $apprentice->delete();
        return response()->json(['message' => 'Aprendiz eliminado correctamente'], 200);
    }
}