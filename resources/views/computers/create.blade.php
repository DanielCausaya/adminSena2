@extends('layouts.app')

@section('title', 'Crear computador')

@section('content')
    <h1 class="mb-4">Crear Computador</h1>

    @include('includes.alert-errors')

    <form action="{{ route('computer.store') }}" method="POST" enctype="multipart/form-data" novalidate>
        @csrf

        <div class="mb-3">
            <label for="number" class="form-label">Numero</label>
            <input type="text" name="number" id="number"
                   class="form-control @error('number') is-invalid @enderror"
                   value="{{ old('number') }}" maxlength="255" required autofocus>
            @error('number')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="brand" class="form-label">Marca</label>
            <input type="text" name="brand" id="brand"
                   class="form-control @error('brand') is-invalid @enderror"
                   value="{{ old('brand') }}" maxlength="255" required>
            @error('brand')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="image" class="form-label">Imagen</label>
            <input type="file" name="image" id="image" accept="image/*"
                   class="form-control @error('image') is-invalid @enderror">
            @error('image')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-success">Crear</button>
            <a href="{{ route('computers.index') }}" class="btn btn-outline-secondary">Cancelar</a>
        </div>
    </form>
@endsection
