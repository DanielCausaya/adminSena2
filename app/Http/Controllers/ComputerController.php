<?php

namespace App\Http\Controllers;

use App\Models\Computer;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ComputerController extends Controller
{
    private function rules(?Computer $computer = null): array
    {
        $number = Rule::unique('computers', 'number');

        if ($computer !== null) {
            $number = $number->ignore($computer->getKey());
        }

        return [
            'number' => ['required', 'string', 'max:255', $number],
            'brand' => ['required', 'string', 'max:255'],
            'image' => ['nullable', 'image', 'max:5120'],
        ];
    }

    private function subirImagen(Request $request, Computer $computer): void
    {
        if (! $request->hasFile('image')) {
            return;
        }

        $subida = cloudinary()->upload($request->file('image')->getRealPath(), [
            'folder' => 'computers',
        ]);

        $computer->image_url = $subida->getSecurePath();
        $computer->save();
    }

    private function wantsApiResponse(Request $request): bool
    {
        return $request->expectsJson() || $request->is('v1/*');
    }

    public function index(Request $request)
    {
        $computers = Computer::orderBy('id')->get();

        if ($this->wantsApiResponse($request)) {
            return response()->json($computers, 200);
        }

        return view('computers.index', ['computers' => $computers->toArray()]);
    }

    public function create()
    {
        return view('computers.create');
    }

    public function show(Request $request, Computer $computer)
    {
        if ($this->wantsApiResponse($request)) {
            return response()->json($computer, 200);
        }

        return view('computers.show', ['computer' => $computer->toArray()]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate($this->rules());

        $data = $validated;
        unset($data['image']);

        $computer = Computer::create($data);

        $this->subirImagen($request, $computer);

        if ($this->wantsApiResponse($request)) {
            return response()->json($computer, 201);
        }

        return redirect()
            ->route('computers.index')
            ->with('success', 'Computador creado correctamente.');
    }

    public function edit(Computer $computer)
    {
        return view('computers.edit', ['computer' => $computer->toArray()]);
    }

    public function update(Request $request, Computer $computer)
    {
        $validated = $request->validate($this->rules($computer));

        $data = $validated;
        unset($data['image']);

        $computer->update($data);

        $this->subirImagen($request, $computer);

        if ($this->wantsApiResponse($request)) {
            return response()->json($computer, 200);
        }

        return redirect()
            ->route('computers.index')
            ->with('success', 'Computador actualizado correctamente.');
    }

    public function destroy(Request $request, Computer $computer)
    {
        try {
            $computer->delete();
        } catch (QueryException $e) {
            if ($this->wantsApiResponse($request)) {
                return response()->json([
                    'message' => 'El computador tiene aprendices asignados y no se puede eliminar.',
                ], 409);
            }

            return redirect()
                ->route('computers.index')
                ->with('error', 'El computador tiene aprendices asignados y no se puede eliminar.');
        }

        if ($this->wantsApiResponse($request)) {
            return response()->json(['message' => 'Computador eliminado correctamente'], 200);
        }

        return redirect()
            ->route('computers.index')
            ->with('success', 'Computador eliminado correctamente.');
    }
}
