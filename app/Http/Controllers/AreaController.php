<?php

namespace App\Http\Controllers;
  
 
use App\Models\Area;
use Illuminate\Http\Request;

class AreaController extends Controller
{
    public function index()
    {
        return Area::all();
    }

    public function store(Request $request)
    {
        $area = Area::create([
            'name' => $request->name
        ]);

        return response()->json($area, 201);
    }

    public function update(Request $request, Area $area)
    {
        $request->validate([
            'name' => 'required|string|max:255'
        ]);

        $area->update([
            'name' => $request->name
        ]);

        return response()->json($area, 200);
    }
}