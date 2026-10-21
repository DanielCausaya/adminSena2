<footer class="bg-dark text-white py-4 mt-5">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h5>Admin SENA</h5>
                <p class="mb-0">Panel de gestión de equipos de cómputo del SENA.</p>
            </div>
            <div class="col-md-6">
                <h5>Navegación</h5>
                <ul class="list-unstyled mb-0">
                    <li><a class="link-light" href="{{ route('computers.index') }}">Computadores</a></li>
                    <li><a class="link-light" href="{{ route('computer.create') }}">Crear computador</a></li>
                </ul>
            </div>
        </div>
        <hr>
        <p class="text-center mb-0">&copy; {{ date('Y') }} Admin SENA</p>
    </div>
</footer>
