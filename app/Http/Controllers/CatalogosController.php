<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Empleado;
use App\Models\Impresora;
use App\Models\CatalogoServicio;
use App\Models\Venta;
use App\Models\Factura;
use App\Models\DetalleVentaServicio;
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
                "Inicio" => url("/homeApp"),
                "Clientes" => url("/catalogos/clientes")
            ]
        ]);
    }

    public function clientesAgregarGet(): View
    {
        return view('catalogos/clientesAgregarGet', [
            "breadcrumbs" => [
                "Inicio" => url("/homeApp"),
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
                "Inicio" => url("/homeApp"),
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
                "Inicio" => url("/homeApp"),
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
                "Inicio" => url("/homeApp"),
                "Impresoras" => url("/catalogos/impresoras")
            ]
        ]);
    }

    public function impresorasAgregarGet(): View
    {
        return view('catalogos/impresorasAgregarGet', [
            "breadcrumbs" => [
                "Inicio" => url("/homeApp"),
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

    public function impresorasEditarGet($id): View
    {
        $impresora = Impresora::findOrFail($id);
        
        return view('catalogos/impresorasEditarGet', [
            'impresora' => $impresora,
            "breadcrumbs" => [
                "Inicio" => url("/homeApp"),
                "Impresoras" => url("/catalogos/impresoras"),
                "Editar" => url("/catalogos/impresoras/editar/{$id}")
            ]
        ]);
    }

    public function impresorasEditarPost(Request $request, $id): RedirectResponse
    {
        $impresora = Impresora::findOrFail($id);
        
        $modelo = $request->input("modelo");
        $numero_serie = $request->input("numero_serie");
        $fecha_entrada = $request->input("fecha_entrada");
        $fecha_salida = $request->input("fecha_salida"); // Será null si no se envía
        
        $impresora->modelo = $modelo;
        $impresora->numero_serie = $numero_serie;
        $impresora->fecha_entrada = $fecha_entrada;
        $impresora->fecha_salida = $fecha_salida;
        
        $impresora->save();

        return redirect("/catalogos/impresoras")->with('success', 'Impresora actualizada correctamente');
    }

    public function serviciosGet(): View
    {
        $servicios = CatalogoServicio::all();
        return view('catalogos/serviciosGet', [
            'servicios' => $servicios,
            "breadcrumbs" => [
                "Inicio" => url("/homeApp"),
                "Servicios" => url("/catalogos/servicios")
            ]
        ]);
    }

    public function serviciosAgregarGet(): View
    {
        return view('catalogos/serviciosAgregarGet', [
            "breadcrumbs" => [
                "Inicio" => url("/homeApp"),
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

    public function serviciosEditarGet($id): View
    {
        $servicio = CatalogoServicio::findOrFail($id);
        
        return view('catalogos/serviciosEditarGet', [
            'servicio' => $servicio,
            "breadcrumbs" => [
                "Inicio" => url("/homeApp"),
                "Servicios" => url("/catalogos/servicios"),
                "Editar" => url("/catalogos/servicios/editar/{$id}")
            ]
        ]);
    }

    public function serviciosEditarPost(Request $request, $id): RedirectResponse
    {
        $servicio = CatalogoServicio::findOrFail($id);
        
        $cantidad_cobrada = $request->input("cantidad_cobrada");
        $diagnostico = $request->input("diagnostico");
        $estado_pago = $request->input("estado_pago");
        
        $servicio->cantidad_cobrada = $cantidad_cobrada;
        $servicio->diagnostico = $diagnostico;
        $servicio->estado_pago = $estado_pago;
        
        $servicio->save();

        return redirect("/catalogos/servicios")->with('success', 'Servicio actualizado correctamente');
    }

    public function ventasGet(): View
    {
        $ventas = Venta::with(['cliente', 'empleado', 'impresora'])
                        ->orderBy('id_venta', 'desc')  // Changed from fecha_venta to id_venta
                        ->paginate(10);

        return view('ventas.ventaGet', [
            'ventas' => $ventas,
            "breadcrumbs" => [
                "Inicio" => url("/homeApp"),
                "Ventas" => url("/ventas")
            ]
        ]);
    }

    public function ventasAgregarGet(): View
    {
        $clientes = Cliente::all();
        $empleados = Empleado::all();
        $impresoras = Impresora::all();
        $servicios = CatalogoServicio::all();

        return view('ventas/ventasAgregarGet', [
            'clientes' => $clientes,
            'empleados' => $empleados,
            'impresoras' => $impresoras,
            'servicios' => $servicios,
            "breadcrumbs" => [
                "Inicio" => url("/homeApp"),
                "Ventas" => url("/ventas"),
                "Agregar" => url("/ventas/agregar")
            ]
        ]);
    }

    public function ventasAgregarPost(Request $request): RedirectResponse
    {
        // Validar datos básicos
        $request->validate([
            'id_cliente' => 'required|exists:cliente,id_cliente',
            'id_empleado' => 'required|exists:empleado,id_empleado',
            'id_impresora' => 'required|exists:impresora,id_impresora',
            'fecha_venta' => 'required|date',
            'metodo_pago' => 'required|string|in:Efectivo,Tarjeta,Transferencia',
            'estado_pago' => 'required|boolean',
            'monto_total' => 'required|numeric|min:0.01',
            'servicios' => 'required|array',
            'servicios.*.id_CatalogoServicio' => 'required|exists:catalogoservicio,id_CatalogoServicio',
            'servicios.*.subtotal' => 'required|numeric|min:0.01',
        ]);

        try {
            // Usar transacción para garantizar la integridad de los datos
            \DB::beginTransaction();

            // Crear la venta
            $venta = new Venta([
                'id_cliente' => $request->input('id_cliente'),
                'id_empleado' => $request->input('id_empleado'),
                'id_impresora' => $request->input('id_impresora'),
                'fecha_venta' => $request->input('fecha_venta'),
                'metodo_pago' => $request->input('metodo_pago'),
                'estado_pago' => $request->input('estado_pago'),
                'monto_total' => $request->input('monto_total'),
            ]);

            $venta->save();
            
            // Actualizar la fecha de salida de la impresora si está vacía
            $impresora = Impresora::find($request->input('id_impresora'));
            if ($impresora && $impresora->fecha_salida === null) {
                $impresora->fecha_salida = $request->input('fecha_venta');
                $impresora->save();
            }

            // Guardar los detalles de servicios
            $serviciosGuardados = 0;
            foreach ($request->input('servicios') as $servicio) {
                if (!empty($servicio['id_CatalogoServicio'])) {
                    $detalle = new DetalleVentaServicio([
                        'id_venta' => $venta->id_venta,
                        'id_CatalogoServicio' => $servicio['id_CatalogoServicio'],
                        'subtotal' => $servicio['subtotal'],
                    ]);
                    $detalle->save();
                    $serviciosGuardados++;
                }
            }

            // Verificar que al menos un servicio haya sido guardado
            if ($serviciosGuardados === 0) {
                throw new \Exception('Debe seleccionar al menos un servicio válido.');
            }

            // Si todo salió bien, confirmar la transacción
            \DB::commit();
            
            return redirect('/ventas')->with('success', 'Venta registrada correctamente');
        } catch (\Exception $e) {
            // Si algo falló, revertir la transacción
            \DB::rollBack();
            
            return back()
                ->withInput()
                ->with('error', 'Error al registrar la venta: ' . $e->getMessage());
        }
    }

    public function ventasDetalleGet($id): View
    {
        // Obtener la venta con todas sus relaciones
        $venta = Venta::with(['cliente', 'empleado', 'impresora', 'detallesVenta.catalogoServicio'])
                    ->findOrFail($id);
        
        // Obtener la factura si existe
        $factura = Factura::where('id_venta', $id)->first();
        
        return view('ventas.ventasDetalleGet', [
            'venta' => $venta,
            'factura' => $factura,
            "breadcrumbs" => [
                "Inicio" => url("/homeApp"),
                "Ventas" => url("/ventas"),
                "Detalle" => url("/ventas/detalle/{$id}")
            ]
        ]);
    }
}
