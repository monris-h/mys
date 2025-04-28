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

    public function clientesGet(Request $request): View
    {
        $query = Cliente::query();
        
        // Aplicar filtros de búsqueda si están presentes
        if ($request->filled('search')) {
            $searchTerm = $request->search;
            $query->where(function($q) use ($searchTerm) {
                $q->where('nombre', 'LIKE', "%{$searchTerm}%")
                  ->orWhere('RFC', 'LIKE', "%{$searchTerm}%");
            });
        }
        
        $clientes = $query->orderBy('id_cliente', 'desc')->paginate(10);
        // Preservar parámetros de búsqueda en la paginación
        $clientes->appends($request->only('search'));
        
        return view('catalogos/clientesGet', [
            'clientes' => $clientes,
            'search' => $request->search,
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
        // Validar los datos antes de intentar guardar
        $validatedData = $request->validate([
            'nombre' => 'required|string|max:50',
            'telefono' => 'required|string|max:15',
            'email' => 'required|email|max:50|unique:cliente,email',
            'RFC' => 'required|string|max:20|unique:cliente,RFC'
        ], [
            'email.unique' => 'Este correo electrónico ya está registrado para otro cliente.',
            'RFC.unique' => 'Este RFC ya está registrado para otro cliente.'
        ]);

        // Crear el cliente con los datos validados
        $cliente = new Cliente([
            "nombre" => $validatedData['nombre'],
            "telefono" => $validatedData['telefono'],
            "email" => $validatedData['email'],
            "RFC" => $validatedData['RFC']
        ]);
        
        $cliente->save();

        return redirect("/catalogos/clientes")->with('success', 'Cliente agregado correctamente');
    }


    public function empleadosGet(Request $request): View
    {
        $query = Empleado::query();
        
        // Filtrar por nombre
        if ($request->filled('search')) {
            $searchTerm = $request->search;
            $query->where('nombre', 'LIKE', "%{$searchTerm}%");
        }
        
        $empleados = $query->orderBy('id_empleado', 'desc')->paginate(10);
        // Preservar parámetros de búsqueda en la paginación
        $empleados->appends($request->only('search'));
        
        return view('catalogos/empleadosGet', [
            'empleados' => $empleados,
            'search' => $request->search,
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

    public function impresorasGet(Request $request): View
    {
        $query = Impresora::query();
        
        // Filtrar por número de serie
        if ($request->filled('search')) {
            $searchTerm = $request->search;
            $query->where('numero_serie', 'LIKE', "%{$searchTerm}%");
        }
        
        $impresoras = $query->orderBy('id_impresora', 'desc')->paginate(10);
        // Preservar parámetros de búsqueda en la paginación
        $impresoras->appends($request->only('search'));
        
        return view('catalogos/impresorasGet', [
            'impresoras' => $impresoras,
            'search' => $request->search,
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
        // Validar los datos antes de intentar guardar
        $validatedData = $request->validate([
            'modelo' => 'required|string|max:50',
            'numero_serie' => 'required|string|max:50|unique:impresora,numero_serie',
            'fecha_entrada' => 'required|date',
            'fecha_salida' => 'nullable|date'
        ], [
            'numero_serie.unique' => 'Este número de serie ya está registrado para otra impresora.'
        ]);

        // Crear el objeto con datos validados
        $impresora = new Impresora([
            "modelo" => $validatedData['modelo'],
            "numero_serie" => $validatedData['numero_serie'],
            "fecha_entrada" => $validatedData['fecha_entrada'],
            "fecha_salida" => $validatedData['fecha_salida']
        ]);
        
        $impresora->save();

        return redirect("/catalogos/impresoras")->with('success', 'Impresora agregada correctamente');
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
        
        // Validación incluyendo regla para ignorar el número de serie actual
        $validatedData = $request->validate([
            'modelo' => 'required|string|max:50',
            'numero_serie' => 'required|string|max:50|unique:impresora,numero_serie,'.$id.',id_impresora',
            'fecha_entrada' => 'required|date',
            'fecha_salida' => 'nullable|date'
        ], [
            'numero_serie.unique' => 'Este número de serie ya está registrado para otra impresora.'
        ]);
        
        // Actualizar con datos validados
        $impresora->modelo = $validatedData['modelo'];
        $impresora->numero_serie = $validatedData['numero_serie'];
        $impresora->fecha_entrada = $validatedData['fecha_entrada'];
        $impresora->fecha_salida = $validatedData['fecha_salida'];
        
        $impresora->save();

        return redirect("/catalogos/impresoras")->with('success', 'Impresora actualizada correctamente');
    }

    public function serviciosGet(Request $request): View
    {
        $query = CatalogoServicio::query();
        
        // Filtrar por nombre (diagnóstico)
        if ($request->filled('search')) {
            $searchTerm = $request->search;
            $query->where('diagnostico', 'LIKE', "%{$searchTerm}%");
        }
        
        $servicios = $query->orderBy('id_CatalogoServicio', 'desc')->paginate(10);
        // Preservar parámetros de búsqueda en la paginación
        $servicios->appends($request->only('search'));
        
        return view('catalogos/serviciosGet', [
            'servicios' => $servicios,
            'search' => $request->search,
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

    public function ventasGet(Request $request): View
    {
        $query = Venta::with(['cliente', 'empleado', 'impresora']);
        
        // Filtrar por nombre de empleado o ID
        if ($request->filled('search')) {
            $searchTerm = $request->search;
            $query->where(function($q) use ($searchTerm) {
                // Buscar por ID de venta
                $q->where('id_venta', 'LIKE', "%{$searchTerm}%")
                  // Buscar por nombre de empleado (usando relación)
                  ->orWhereHas('empleado', function($query) use ($searchTerm) {
                      $query->where('nombre', 'LIKE', "%{$searchTerm}%");
                  });
            });
        }
        
        $ventas = $query->orderBy('id_venta', 'desc')->paginate(10);
        $ventas->appends($request->only('search'));

        return view('ventas.ventaGet', [
            'ventas' => $ventas,
            'search' => $request->search,
            "breadcrumbs" => [
                "Inicio" => url("/homeApp"),
                "Ventas" => url("/ventas")
            ]
        ]);
    }

    public function ventasAgregarGet(): View
    {
        $clientes = Cliente::all();
        
        // Modificado para aceptar tanto "Activo" como "1" en el campo estado
        $empleados = Empleado::where('estado', 'Activo')
                            ->orWhere('estado', '1')
                            ->get();
                            
        // Asegurar que solo se muestren impresoras disponibles (sin fecha de salida)
        $impresoras = Impresora::whereNull('fecha_salida')
                              ->orderBy('modelo')
                              ->get();
        
        // Solo servicios activos
        $servicios = CatalogoServicio::where('estado_pago', 1)->get();

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

    public function empleadosEditarGet(int $id_empleado): View
    {
        // Busca el empleado por ID o falla (404) si no existe
        $empleado = Empleado::findOrFail($id_empleado);

        // Prepara breadcrumbs para la vista de edición
        $breadcrumbs = [
            "Inicio" => url("/"),
            "Empleados" => url("/catalogos/empleados"),
            "Editar" => url("/catalogos/empleados/editar/{$id_empleado}") // URL actual
        ];

        // Pasa el empleado y breadcrumbs a la vista
        return view('catalogos/empleadosEditarGet', [
            'empleado' => $empleado,
            'breadcrumbs' => $breadcrumbs
        ]);
    }

    /**
     * Actualiza un empleado existente en la base de datos.
     *
     * @param  Request  $request Los datos del formulario.
     * @param  int  $id_empleado El ID del empleado a actualizar.
     * @return RedirectResponse
     */
    public function empleadosEditarPost(Request $request, int $id_empleado): RedirectResponse
    {
        // Busca el empleado existente
        $empleado = Empleado::findOrFail($id_empleado);

        // Implementar validación real
        $validatedData = $request->validate([
            'nombre' => 'required|string|max:50',
            'fecha_ingreso' => 'required|date',
            'telefono' => 'required|string|max:15',
            'rol' => 'required|string|max:50',
            'estado' => 'required|in:0,1',
        ]);

        // Actualiza los atributos del modelo Empleado
        $empleado->nombre = strtoupper($validatedData['nombre']);
        $empleado->fecha_ingreso = $validatedData['fecha_ingreso'];
        $empleado->telefono = $validatedData['telefono'];
        $empleado->rol = $validatedData['rol'];
        $empleado->estado = $validatedData['estado'];

        // Guarda los cambios
        $empleado->save();

        // Redirige a la lista con mensaje de éxito
        return redirect('/catalogos/empleados')->with('success', 'Empleado actualizado exitosamente.');
    }

    public function clientesEditarGet(int $id_cliente): View
    {
        // Busca el cliente por ID o falla si no lo encuentra
        $cliente = Cliente::findOrFail($id_cliente);

        // Prepara los breadcrumbs para la vista de edición
        $breadcrumbs = [
            "Inicio" => url("/"),
            "Clientes" => url("/catalogos/clientes"),
            "Editar" => url("/catalogos/clientes/editar/{$id_cliente}") // URL de esta misma vista
        ];

        // Pasa el cliente encontrado y los breadcrumbs a la vista
        return view('catalogos/clientesEditarGet', [
            'cliente' => $cliente,
            'breadcrumbs' => $breadcrumbs
        ]);
    }

    /**
     * Actualiza un cliente existente en la base de datos.
     *
     * @param  Request  $request Los datos del formulario.
     * @param  int  $id_cliente El ID del cliente a actualizar.
     * @return RedirectResponse
     */
    public function clientesEditarPost(Request $request, int $id_cliente): RedirectResponse
    {
        // Busca el cliente existente o falla si no existe
        $cliente = Cliente::findOrFail($id_cliente);

        // Implementar validación real
        $validatedData = $request->validate([
            'nombre' => 'required|string|max:50',
            'telefono' => 'required|string|max:15',
            'email' => 'required|email|max:50|unique:cliente,email,' . $id_cliente . ',id_cliente',
            'RFC' => 'required|string|max:20|unique:cliente,RFC,' . $id_cliente . ',id_cliente',
        ]);

        // Actualiza los atributos del modelo Cliente
        $cliente->nombre = $validatedData['nombre'];
        $cliente->telefono = $validatedData['telefono'];
        $cliente->email = $validatedData['email'];
        $cliente->RFC = $validatedData['RFC'];

        // Guarda los cambios en la base de datos
        $cliente->save();

        // Redirige de vuelta a la lista de clientes con un mensaje de éxito
        return redirect('/catalogos/clientes')->with('success', 'Cliente actualizado exitosamente.');
    }

    public function ventasEditarGet($id): View
    {
        // Obtener la venta con sus relaciones
        $venta = Venta::with(['cliente', 'empleado', 'impresora', 'detallesVenta.catalogoServicio'])
                    ->findOrFail($id);
        
        return view('ventas.ventasEditarGet', [
            'venta' => $venta,
            "breadcrumbs" => [
                "Inicio" => url("/homeApp"),
                "Ventas" => url("/ventas"),
                "Editar" => url("/ventas/editar/{$id}")
            ]
        ]);
    }

    public function ventasEditarPost(Request $request, $id): RedirectResponse
    {
        // Obtener la venta
        $venta = Venta::findOrFail($id);
        
        // Verificar si la venta es editable (solo si está pendiente)
        if ($venta->estado_pago == 0) {
            // Validar datos básicos
            $validatedData = $request->validate([
                'estado_pago' => 'required|boolean',
            ]);
            
            // Actualizar estado de pago
            $venta->estado_pago = $validatedData['estado_pago'];
            $venta->save();
            
            return redirect('/ventas')->with('success', 'Estado de pago actualizado correctamente');
        }
        
        return redirect('/ventas')->with('error', 'No se puede editar una venta que ya ha sido pagada');
    }
}
