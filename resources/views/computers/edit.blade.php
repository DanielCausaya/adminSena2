@extends('layouts.app')

@section('title', 'Editar computador')

@section('content')
    <h1 class="mb-4">Editar Computador</h1>

    @include('includes.alert-errors')

    <form action="{{ route('computer.update', $computer['id']) }}" method="POST" enctype="multipart/form-data" novalidate>
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="number" class="form-label">Número</label>
            <input type="text" name="number" id="number"
                   class="form-control @error('number') is-invalid @enderror"
                   value="{{ old('number', $computer['number'] ?? '') }}" maxlength="255" required autofocus>
            @error('number')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="brand" class="form-label">Marca</label>
            <input type="text" name="brand" id="brand"
                   class="form-control @error('brand') is-invalid @enderror"
                   value="{{ old('brand', $computer['brand'] ?? '') }}" maxlength="255" required>
            @error('brand')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="image" class="form-label">Imagen</label>

            @if (! empty($computer['image_url']))
                <div class="mb-2">
                    <img src="{{ $computer['image_url'] }}" alt="Imagen actual"
                         style="width: 120px; height: 90px; object-fit: cover;" class="rounded border">
                </div>
            @endif

            <input type="file" name="image" id="image" accept="image/*"
                   class="form-control @error('image') is-invalid @enderror">
            @error('image')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
            <small class="text-muted">Si no eliges una imagen, se conserva la actual.</small>
        </div>

        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-success">Actualizar</button>
            <a href="{{ route('computers.index') }}" class="btn btn-outline-secondary">Cancelar</a>
        </div>
    </form>
@endsection
