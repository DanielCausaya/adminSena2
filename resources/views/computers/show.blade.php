@extends('layouts.app')

@section('title', 'Detalle de computador')

@section('content')
    <h2 class="mb-4 text-success">Detalles de Computador</h2>

    <div class="table-responsive">
        <table class="table table-bordered table-hover align-middle">
            <thead class="table-success">
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Imagen</th>
                    <th scope="col">Número</th>
                    <th scope="col">Marca</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $computer['id'] }}</td>
                    <td>
                        @if (! empty($computer['image_url']))
                            <img src="{{ $computer['image_url'] }}" alt="Computador {{ $computer['number'] }}"
                                 style="width: 180px; height: 130px; object-fit: cover;" class="rounded border">
                        @else
                            <span class="text-muted">Sin imagen</span>
                        @endif
                    </td>
                    <td>{{ $computer['number'] }}</td>
                    <td>{{ $computer['brand'] }}</td>
                </tr>
            </tbody>
        </table>
    </div>

    <a href="{{ route('computers.index') }}" class="btn btn-outline-secondary">Volver al listado</a>
@endsection
