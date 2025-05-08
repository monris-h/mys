<?php

namespace App\Http\Controllers;

use App\Models\Impresora;
use App\Models\Venta;
use App\Models\CatalogoServicio;
use App\Models\DetalleVentaServicio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class ReportesController extends Controller
{
    /**
     * Mostrar la página principal de reportes
     */
    public function index(): View
    {
        try {
            // Obtener datos para la gráfica de ventas
            $ventasPorMes = $this->getVentasPorMes();
            
            return view('reportes.index', [
                "ventasPorMes" => json_encode($ventasPorMes),
                "breadcrumbs" => [
                    "Inicio" => url("/homeApp"),
                    "Reportes" => url("/reportes")
                ]
            ]);
        } catch (\Exception $e) {
            \Log::error("Error en ReportesController: " . $e->getMessage());
            return view('reportes.index', [
                "ventasPorMes" => json_encode([]),
                "error" => 'No se pudieron cargar los datos correctamente',
                "breadcrumbs" => [
                    "Inicio" => url("/homeApp"),
                    "Reportes" => url("/reportes")
                ]
            ]);
        }
    }
    
    /**
     * Obtener datos de ventas agrupados por mes para la gráfica
     */
    private function getVentasPorMes()
    {
        $año = now()->year;
        
        try {
            // Consulta para obtener el monto total de ventas por mes
            $ventasPorMes = DB::table('venta')
                ->select(
                    DB::raw('MONTH(fecha_venta) as mes'),
                    DB::raw('SUM(monto_total) as total')
                )
                ->whereYear('fecha_venta', $año)
                ->groupBy('mes')
                ->orderBy('mes')
                ->get();
                
            // Crear array con todos los meses (1-12)
            $datosCompletos = [];
            $nombresMeses = [
                'Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio',
                'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'
            ];
            
            // Inicializar con ceros
            foreach ($nombresMeses as $index => $nombre) {
                $datosCompletos[$index] = [
                    'mes' => $nombre,
                    'total' => 0
                ];
            }
            
            // Llenar con datos reales donde existan
            foreach ($ventasPorMes as $venta) {
                $indice = $venta->mes - 1; // Ajustar para índice base 0
                if (isset($datosCompletos[$indice])) {
                    $datosCompletos[$indice]['total'] = (float)$venta->total;
                }
            }
            
            // Convertir a array indexado para Chart.js
            $resultado = array_values($datosCompletos);
            
            return $resultado;
        } catch (\Exception $e) {
            \Log::error("Error obteniendo datos de ventas: " . $e->getMessage());
            // Devolver array vacío en caso de error
            return [];
        }
    }
    
    /**
     * Generar reporte: Historial de reparaciones por impresora
     */
    public function historialReparaciones(Request $request): View
    {
        // Obtener todas las impresoras para el filtro
        $impresoras = Impresora::orderBy('modelo')->get();
        
        $impresoraId = $request->input('impresora');
        
        // Preparar la consulta base - removiendo subtotal
        $query = DB::table('impresora')
            ->join('venta', 'impresora.id_impresora', '=', 'venta.id_impresora')
            ->join('detalleventaservicio', 'venta.id_venta', '=', 'detalleventaservicio.id_venta')
            ->join('catalogoservicio', 'detalleventaservicio.id_CatalogoServicio', '=', 'catalogoservicio.id_CatalogoServicio')
            ->join('cliente', 'venta.id_cliente', '=', 'cliente.id_cliente')
            ->select(
                'impresora.id_impresora',
                'impresora.modelo',
                'impresora.numero_serie',
                'venta.fecha_venta',
                'venta.id_venta',
                'catalogoservicio.diagnostico',
                'cliente.nombre as cliente_nombre'
            );
            
        // Aplicar filtro si se seleccionó una impresora
        if ($impresoraId) {
            $query->where('impresora.id_impresora', $impresoraId);
        }
        
        // Ordenar por impresora y fecha
        $historialServicios = $query->orderBy('impresora.id_impresora')
                                   ->orderBy('venta.fecha_venta', 'desc')
                                   ->get();
                                   
        // Agrupar por impresora para mostrar mejor en la vista
        $serviciosPorImpresora = $historialServicios->groupBy('id_impresora');
        
        return view('reportes.historial_reparaciones', [
            'impresoras' => $impresoras,
            'serviciosPorImpresora' => $serviciosPorImpresora,
            'impresoraSeleccionada' => $impresoraId,
            'historialServicios' => $historialServicios,
            "breadcrumbs" => [
                "Inicio" => url("/homeApp"),
                "Reportes" => url("/reportes"),
                "Historial de Reparaciones" => url("/reportes/historial-reparaciones")
            ]
        ]);
    }

    /**
     * Generar reporte: Listado de impresoras pendientes
     */
    public function impresorasPendientes(): View
    {
        // Obtener impresoras sin fecha de salida (aún no entregadas)
        $impresorasSinSalida = DB::table('impresora')
            ->leftJoin('venta', 'impresora.id_impresora', '=', 'venta.id_impresora')
            ->select(
                'impresora.id_impresora',
                'impresora.modelo',
                'impresora.numero_serie',
                'impresora.fecha_entrada',
                'venta.id_venta',
                'venta.estado_pago',
                DB::raw("'No entregada' as estado_pendiente")
            )
            ->whereNull('impresora.fecha_salida')
            ->get();
            
        // Obtener impresoras con pagos pendientes
        $impresorasPagoPendiente = DB::table('impresora')
            ->join('venta', 'impresora.id_impresora', '=', 'venta.id_impresora')
            ->select(
                'impresora.id_impresora',
                'impresora.modelo',
                'impresora.numero_serie',
                'impresora.fecha_entrada',
                'venta.id_venta',
                'venta.estado_pago',
                DB::raw("'Pago pendiente' as estado_pendiente")
            )
            ->where('venta.estado_pago', 0)
            ->get();
            
        // Combinar los resultados
        $impresorasPendientes = $impresorasSinSalida->concat($impresorasPagoPendiente)->unique('id_impresora');
        
        return view('reportes.impresoras_pendientes', [
            'impresorasPendientes' => $impresorasPendientes,
            "breadcrumbs" => [
                "Inicio" => url("/homeApp"),
                "Reportes" => url("/reportes"),
                "Impresoras Pendientes" => url("/reportes/impresoras-pendientes")
            ]
        ]);
    }

    /**
     * Generar reporte: Informe de ingresos por servicios
     */
    public function ingresosServicios(Request $request): View
    {
        // Preparar filtros de fechas
        $fechaInicio = $request->input('fecha_inicio');
        $fechaFin = $request->input('fecha_fin');
        
        // Construir la consulta base
        $query = DB::table('catalogoservicio')
            ->join('detalleventaservicio', 'catalogoservicio.id_CatalogoServicio', '=', 'detalleventaservicio.id_CatalogoServicio')
            ->join('venta', 'detalleventaservicio.id_venta', '=', 'venta.id_venta')
            ->select(
                'catalogoservicio.id_CatalogoServicio',
                'catalogoservicio.diagnostico',
                DB::raw('COUNT(detalleventaservicio.id_detalle) as total_servicios'),
                DB::raw('SUM(detalleventaservicio.subtotal) as ingreso_total')
            )
            ->groupBy('catalogoservicio.id_CatalogoServicio', 'catalogoservicio.diagnostico');
        
        // Aplicar filtros de fecha si están presentes
        if ($fechaInicio && $fechaFin) {
            $query->whereBetween('venta.fecha_venta', [$fechaInicio, $fechaFin]);
        } elseif ($fechaInicio) {
            $query->where('venta.fecha_venta', '>=', $fechaInicio);
        } elseif ($fechaFin) {
            $query->where('venta.fecha_venta', '<=', $fechaFin);
        }
        
        // Ejecutar la consulta
        $ingresosPorServicio = $query->get();
        
        // Calcular totales generales
        $totalServicios = $ingresosPorServicio->sum('total_servicios');
        $totalIngresos = $ingresosPorServicio->sum('ingreso_total');
        
        // Obtener las fechas mínima y máxima de las ventas para el datepicker
        $fechasLimite = DB::table('venta')
            ->select(
                DB::raw('MIN(fecha_venta) as fecha_min'),
                DB::raw('MAX(fecha_venta) as fecha_max')
            )
            ->first();
        
        return view('reportes.ingresos_servicios', [
            'ingresosPorServicio' => $ingresosPorServicio,
            'totalServicios' => $totalServicios,
            'totalIngresos' => $totalIngresos,
            'fechaInicio' => $fechaInicio,
            'fechaFin' => $fechaFin,
            'fechaMin' => $fechasLimite->fecha_min ?? now()->subYear()->format('Y-m-d'),
            'fechaMax' => $fechasLimite->fecha_max ?? now()->format('Y-m-d'),
            "breadcrumbs" => [
                "Inicio" => url("/homeApp"),
                "Reportes" => url("/reportes"),
                "Ingresos por Servicios" => url("/reportes/ingresos-servicios")
            ]
        ]);
    }
}
