<?php

namespace App\Providers;


 
 
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    public function register()
    {
        //
    }

    public function boot()
    {
        $this->mapApiRoutes();
    }

  protected function mapApiRoutes()
{
    Route::prefix('v1')
    ->middleware('api')
    ->group(base_path('routes/api.php'));
}}