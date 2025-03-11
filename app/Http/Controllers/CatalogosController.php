<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Empleado;
use App\Models\Impresora;
use App\Models\CatalogoServicio;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CatalogosController extends Controller
{

    public function home(): View
    {
        return view('home', ["breadcrumbs" => []]);
    }

    public function clientesGet(): View
    {
        $clientes = Cliente::all();
        return view('catalogos/clientesGet', [
            'clientes' => $clientes,
            "breadcrumbs" => [
                "Inicio" => url("/"),
                "Clientes" => url("/catalogos/clientes")
            ]
        ]);
    }

    public function empleadosGet(): View
    {
        $empleados = Empleado::all();
        return view('catalogos/empleadosGet', [
            'empleados' => $empleados,
            "breadcrumbs" => [
                "Inicio" => url("/"),
                "Empleados" => url("/catalogos/empleados")
            ]
        ]);
    }

    public function impresorasGet(): View
    {
        $impresoras = Impresora::all();
        return view('catalogos/impresorasGet', [
            'impresoras' => $impresoras,
            "breadcrumbs" => [
                "Inicio" => url("/"),
                "Impresoras" => url("/catalogos/impresoras")
            ]
        ]);
    }

    public function serviciosGet(): View
    {
        $servicios = CatalogoServicio::all();
        return view('catalogos/serviciosGet', [
            'servicios' => $servicios,
            "breadcrumbs" => [
                "Inicio" => url("/"),
                "Servicios" => url("/catalogos/servicios")
            ]
        ]);
    }
}
