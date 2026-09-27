<?php

namespace App\Http\Controllers;

use App\Models\TrainingCenter;
use Illuminate\Http\Request;

class TrainingCenterController extends Controller
{
    public function index()
    {
        return TrainingCenter::all();
    }

    public function show(TrainingCenter $trainingCenter)
    {
        return response()->json($trainingCenter, 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'required|string|max:255'
        ]);

        $trainingCenter = TrainingCenter::create($request->all());
        return response()->json($trainingCenter, 201);
    }

    public function update(Request $request, TrainingCenter $trainingCenter)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'required|string|max:255'
        ]);

        $trainingCenter->update($request->all());
        return response()->json($trainingCenter, 200);
    }

    public function destroy(TrainingCenter $trainingCenter)
    {
        $trainingCenter->delete();
        return response()->json(['message' => 'Centro de formación eliminado correctamente'], 200);
    }
}