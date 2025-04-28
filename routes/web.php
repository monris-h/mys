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
    Route::get('/homeApp', function () {return view('homeApp');})->middleware('auth');

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
    
    // CATALOGOS - FORMULARIOS EDITAR (Agregamos rutas de edición)
    Route::get('/catalogos/impresoras/editar/{id}', [CatalogosController::class, 'impresorasEditarGet']);
    Route::post('/catalogos/impresoras/editar/{id}', [CatalogosController::class, 'impresorasEditarPost']);
    Route::get('/catalogos/servicios/editar/{id}', [CatalogosController::class, 'serviciosEditarGet']);
    Route::post('/catalogos/servicios/editar/{id}', [CatalogosController::class, 'serviciosEditarPost']);

    // CATALOGOS - POST (GUARDAR)
    Route::post('/catalogos/clientes/agregar', [CatalogosController::class, 'clientesAgregarPost']);
    Route::post('/catalogos/empleados/agregar', [CatalogosController::class, 'empleadosAgregarPost']);
    Route::post('/catalogos/impresoras/agregar', [CatalogosController::class, 'impresorasAgregarPost']);
    Route::post('/catalogos/servicios/agregar', [CatalogosController::class, 'serviciosAgregarPost']);

    // Rutas para Ventas
    Route::get('/ventas', [CatalogosController::class, 'ventasGet']);
    Route::get('/ventas/agregar', [CatalogosController::class, 'ventasAgregarGet']);
    Route::post('/ventas/agregar', [CatalogosController::class, 'ventasAgregarPost']);
    Route::get('/ventas/detalle/{id}', [CatalogosController::class, 'ventasDetalleGet']);
});
