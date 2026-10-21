@if ($errors->any())
    <div class="alert alert-danger" role="alert">
        <strong>No se pudo guardar el registro.</strong>
        <ul class="mb-0 mt-2">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
