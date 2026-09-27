<?php

namespace App\Http\Controllers;


use App\Models\Computer;
use Illuminate\Http\Request;

class ComputerController extends Controller
{
    public function index()
    {
        return Computer::all();
    }

    public function show(Computer $computer)
    {
        return response()->json($computer, 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'brand' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'serial_number' => 'required|string|unique:computers,serial_number'
        ]);

        $computer = Computer::create($request->all());
        return response()->json($computer, 201);
    }

    public function update(Request $request, Computer $computer)
    {
        $request->validate([
            'brand' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'serial_number' => 'required|string|unique:computers,serial_number,' . $computer->id
        ]);

        $computer->update($request->all());
        return response()->json($computer, 200);
    }

    public function destroy(Computer $computer)
    {
        $computer->delete();
        return response()->json(['message' => 'Computador eliminado correctamente'], 200);
    }
}