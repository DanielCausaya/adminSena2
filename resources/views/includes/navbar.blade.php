<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container">
        <a class="navbar-brand" href="{{ route('computers.index') }}">
            Admin SENA
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Alternar navegación">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('computers.*') ? 'active' : '' }}"
                        aria-current="page" href="{{ route('computers.index') }}">Computadores</a>
                </li>
            </ul>

            <a href="{{ route('computer.create') }}" class="btn btn-outline-light btn-sm">
                Nuevo computador
            </a>
        </div>
    </div>
</nav>
