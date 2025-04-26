<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Empleado;
use App\Models\Impresora;
use App\Models\CatalogoServicio;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

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

    public function clientesAgregarGet(): View
    {
        return view('catalogos/clientesAgregarGet', [
            "breadcrumbs" => [
                "Inicio" => url("/"),
                "Clientes" => url("/catalogos/clientes"),
                "Agregar" => url("/catalogos/clientes/agregar")
            ]
        ]);
    }

    public function clientesAgregarPost(Request $request): RedirectResponse
    {
        $nombre = $request->input("nombre");
        $telefono = $request->input("telefono");
        $email = $request->input("email");
        $rfc = $request->input("RFC"); 

        $cliente = new Cliente([
            "nombre" => $nombre,
            "telefono" => $telefono,
            "email" => $email,
            "RFC" => $rfc
        ]);
        $cliente->save();

        return redirect("/catalogos/clientes");
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

    public function empleadosAgregarGet(): View
    {
        // Si necesitaras pasar datos al formulario (ej: una lista de roles), los buscarías aquí
        // $roles = Roles::all(); // Ejemplo
        return view('catalogos/empleadosAgregarGet', [
            // 'roles' => $roles, // Ejemplo si pasaras datos
            "breadcrumbs" => [
                "Inicio" => url("/"),
                "Empleados" => url("/catalogos/empleados"),
                "Agregar" => url("/catalogos/empleados/agregar")
            ]
        ]);
    }

    public function empleadosAgregarPost(Request $request): RedirectResponse
    {
        $nombre = $request->input("nombre");
        $estado = $request->input("estado");
        $fecha_ingreso = $request->input("fecha_ingreso");
        $telefono = $request->input("telefono");
        $rol = $request->input("rol");

        $empleado = new Empleado([
            "nombre" => strtoupper($nombre),
            "estado" => $estado,
            "fecha_ingreso" => $fecha_ingreso,
            "telefono" => $telefono,
            "rol" => $rol
        ]);
        $empleado->save();

        return redirect("/catalogos/empleados");
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

    public function impresorasAgregarGet(): View
    {
        return view('catalogos/impresorasAgregarGet', [
            "breadcrumbs" => [
                "Inicio" => url("/"),
                "Impresoras" => url("/catalogos/impresoras"),
                "Agregar" => url("/catalogos/impresoras/agregar")
            ]
        ]);
    }

    public function impresorasAgregarPost(Request $request): RedirectResponse
    {
        $modelo = $request->input("modelo");
        $numero_serie = $request->input("numero_serie");
        $fecha_entrada = $request->input("fecha_entrada");
        $fecha_salida = $request->input("fecha_salida"); // Será null si no se envía

        $impresora = new Impresora([
            "modelo" => $modelo,
            "numero_serie" => $numero_serie,
            "fecha_entrada" => $fecha_entrada,
            "fecha_salida" => $fecha_salida
        ]);
        $impresora->save();

        return redirect("/catalogos/impresoras");
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

    public function serviciosAgregarGet(): View
    {
        return view('catalogos/serviciosAgregarGet', [
            "breadcrumbs" => [
                "Inicio" => url("/"),
                "Servicios" => url("/catalogos/servicios"),
                "Agregar" => url("/catalogos/servicios/agregar")
            ]
        ]);
    }

    public function serviciosAgregarPost(Request $request): RedirectResponse
    {
        $cantidad_cobrada = $request->input("cantidad_cobrada");
        $diagnostico = $request->input("diagnostico");
        $estado_pago = $request->input("estado_pago");

        $servicio = new CatalogoServicio([
            "cantidad_cobrada" => $cantidad_cobrada,
            "diagnostico" => $diagnostico,
            "estado_pago" => $estado_pago
        ]);
        $servicio->save();

        return redirect("/catalogos/servicios");
    }
    
}
