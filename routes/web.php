<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CatalogosController;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/', [CatalogosController::class, 'home'])->name('home');
Route::get('/', function () {
    return view('home',["breadcrumbs" => []]);
});
Route::get('/catalogos/clientes', [CatalogosController::class, 'clientesGet']);
Route::get('/catalogos/empleados', [CatalogosController::class, 'empleadosGet']);
Route::get('/catalogos/impresoras', [CatalogosController::class, 'impresorasGet']);
Route::get('/catalogos/servicios', [CatalogosController::class, 'serviciosGet']);

