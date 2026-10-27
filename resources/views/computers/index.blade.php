@extends('layouts.app')

@section('title', 'Computadores')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="mb-0">Lista de Computadores</h1>

        <a href="{{ route('computer.create') }}" class="btn btn-success btn-sm">Nuevo computador</a>
    </div>

    @include('includes.alert-success')
    @include('includes.alert-error')

    <div class="table-responsive">
        <table class="table table-bordered table-striped align-middle">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Imagen</th>
                    <th>Número</th>
                    <th>Marca</th>
                    <th class="text-center">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($computers as $computer)
                    <tr>
                        <td>{{ $computer['id'] }}</td>
                        <td>
                            @if (! empty($computer['image_url']))
                                <img src="{{ $computer['image_url'] }}"
                                     alt="Computador {{ $computer['number'] }}"
                                     style="width: 90px; height: 65px; object-fit: cover;"
                                     class="rounded border">
                            @else
                                <span class="text-muted">Sin imagen</span>
                            @endif
                        </td>
                        <td>{{ $computer['number'] }}</td>
                        <td>{{ $computer['brand'] }}</td>
                        <td class="text-center">
                            <a href="{{ route('computer.show', $computer['id']) }}" class="btn btn-info btn-sm">
                                Ver más
                            </a>
                            <a href="{{ route('computer.edit', $computer['id']) }}" class="btn btn-warning btn-sm">
                                Editar
                            </a>
                            <form action="{{ route('computer.destroy', $computer['id']) }}" method="POST"
                                class="d-inline"
                                onsubmit="return confirm('¿Estás seguro de eliminar este computador?')">

                                @csrf
                                @method('DELETE')

                                <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center text-muted">No hay computadores registrados.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
