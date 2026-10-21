<?php

use App\Http\Controllers\ComputerController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Rutas del panel de administracion. La API REST vive en routes/api.php
| (prefijo /v1) y ambas capas comparten los mismos controladores: cada metodo
| decide si responde JSON (cuando el cliente pide application/json) o
| redirige a la vista (cuando viene de un formulario).
|
*/

Route::redirect('/', '/computers');

Route::get('computers', [ComputerController::class, 'index'])->name('computers.index');
Route::get('computer/create', [ComputerController::class, 'create'])->name('computer.create');
Route::post('computer', [ComputerController::class, 'store'])->name('computer.store');
Route::get('computer/{computer}', [ComputerController::class, 'show'])->name('computer.show');
Route::get('computer/{computer}/editar', [ComputerController::class, 'edit'])->name('computer.edit');
Route::put('computer/{computer}', [ComputerController::class, 'update'])->name('computer.update');
Route::delete('computer/{computer}', [ComputerController::class, 'destroy'])->name('computer.destroy');
