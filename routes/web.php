<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CatalogosController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;

// Rutas públicas
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/', [CatalogosController::class, 'home'])->name('home');

// 🛡️ Rutas protegidas: SOLO si el usuario está logueado
Route::middleware(['auth'])->group(function () {

    // CATALOGOS - GET
    Route::get('/catalogos/clientes', [CatalogosController::class, 'clientesGet']);
    Route::get('/catalogos/empleados', [CatalogosController::class, 'empleadosGet']);
    Route::get('/catalogos/impresoras', [CatalogosController::class, 'impresorasGet']);
    Route::get('/catalogos/servicios', [CatalogosController::class, 'serviciosGet']);

    // CATALOGOS - FORMULARIOS AGREGAR
    Route::get('/catalogos/clientes/agregar', [CatalogosController::class, 'clientesAgregarGet']);
    Route::get('/catalogos/empleados/agregar', [CatalogosController::class, 'empleadosAgregarGet']);
    Route::get('/catalogos/impresoras/agregar', [CatalogosController::class, 'impresorasAgregarGet']);
    Route::get('/catalogos/servicios/agregar', [CatalogosController::class, 'serviciosAgregarGet']);

    // CATALOGOS - POST (GUARDAR)
    Route::post('/catalogos/clientes/agregar', [CatalogosController::class, 'clientesAgregarPost']);
    Route::post('/catalogos/empleados/agregar', [CatalogosController::class, 'empleadosAgregarPost']);
    Route::post('/catalogos/impresoras/agregar', [CatalogosController::class, 'impresorasAgregarPost']);
    Route::post('/catalogos/servicios/agregar', [CatalogosController::class, 'serviciosAgregarPost']);
});

// Rutas para Ventas
Route::get('/ventas', [App\Http\Controllers\CatalogosController::class, 'ventasGet'])->name('ventas.index');
Route::get('/ventas/create', [App\Http\Controllers\CatalogosController::class, 'ventasCreate'])->name('ventas.create');
Route::post('/ventas', [App\Http\Controllers\CatalogosController::class, 'ventasStore'])->name('ventas.store');
Route::get('/ventas/{id}', [App\Http\Controllers\CatalogosController::class, 'ventasShow'])->name('ventas.show');
Route::get('/ventas/{id}/edit', [App\Http\Controllers\CatalogosController::class, 'ventasEdit'])->name('ventas.edit');
Route::put('/ventas/{id}', [App\Http\Controllers\CatalogosController::class, 'ventasUpdate'])->name('ventas.update');
Route::delete('/ventas/{id}', [App\Http\Controllers\CatalogosController::class, 'ventasDestroy'])->name('ventas.destroy');

