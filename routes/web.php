<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CatalogosController;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/', [CatalogosController::class, 'home'])->name('home');
<<<<<<< Updated upstream
Route::get('/', function () {
    return view('home',["breadcrumbs" => []]);
=======

// 🛡️ Rutas protegidas: SOLO si el usuario está logueado
Route::middleware(['auth'])->group(function () {
    Route::get('/homeApp', [HomeController::class, 'index']);
    
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

    // CATALOGOS - FORMULARIOS EDITAR
    Route::get('/catalogos/clientes/editar/{id_cliente}', [CatalogosController::class, 'clientesEditarGet']);
    Route::post('/catalogos/clientes/editar/{id_cliente}', [CatalogosController::class, 'clientesEditarPost']); // Changed from PUT to POST

    // Keep only one version of empleados routes with consistent POST method
    Route::get('/catalogos/empleados/editar/{id_empleado}', [CatalogosController::class, 'empleadosEditarGet']);
    Route::post('/catalogos/empleados/editar/{id_empleado}', [CatalogosController::class, 'empleadosEditarPost']); // Changed from PUT to POST

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
    
    // Ventas - Editar
    Route::get('/ventas/editar/{id}', [CatalogosController::class, 'ventasEditarGet']);
    Route::post('/ventas/editar/{id}', [CatalogosController::class, 'ventasEditarPost']);

    // Ventas - Eliminar
    Route::delete('/ventas/{id_venta}', [CatalogosController::class, 'ventasDestroy'])->name('ventas.destroy');
>>>>>>> Stashed changes
});
Route::get('/catalogos/clientes', [CatalogosController::class, 'clientesGet']);
Route::get('/catalogos/empleados', [CatalogosController::class, 'empleadosGet']);
Route::get('/catalogos/impresoras', [CatalogosController::class, 'impresorasGet']);
Route::get('/catalogos/servicios', [CatalogosController::class, 'serviciosGet']);

Route::get('/catalogos/clientes/agregar', [CatalogosController::class, 'clientesAgregarGet']);
Route::get('/catalogos/empleados/agregar', [CatalogosController::class, 'empleadosAgregarGet']);
Route::get('/catalogos/impresoras/agregar', [CatalogosController::class, 'impresorasAgregarGet']);
Route::get('/catalogos/servicios/agregar', [CatalogosController::class, 'serviciosAgregarGet']);

Route::post('/catalogos/clientes/agregar', [CatalogosController::class, 'clientesAgregarPost']);
Route::post('/catalogos/empleados/agregar', [CatalogosController::class, 'empleadosAgregarPost']);
Route::post('/catalogos/impresoras/agregar', [CatalogosController::class, 'impresorasAgregarPost']);
Route::post('/catalogos/servicios/agregar', [CatalogosController::class, 'serviciosAgregarPost']);

