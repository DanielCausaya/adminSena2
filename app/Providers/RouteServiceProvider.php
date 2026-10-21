<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * Se registran las rutas usando el closure routes() del framework (y no
     * mapApiRoutes()/mapWebRoutes() en el boot) porque el base provider
     * engancha ahi el refresco del indice de nombres de ruta. Si las rutas se
     * registran por fuera de ese closure, el refresco ocurre antes y
     * route('nombre') deja de encontrar las rutas con nombre.
     */
    public function boot()
    {
        $this->routes(function () {
            Route::prefix('v1')
                ->middleware('api')
                ->group(base_path('routes/api.php'));

            Route::middleware('web')
                ->group(base_path('routes/web.php'));
        });
    }
}
