<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Venta;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(): View
    {
        try {
            // Obtener datos para la gráfica de ventas
            $ventasPorMes = $this->getVentasPorMes();
            
            // Fecha actual
            $mesActual = now()->month;
            $añoActual = now()->year;
                
            // Calcular total de ventas del mes actual
            $ventasMesActual = DB::table('venta')
                ->whereMonth('fecha_venta', $mesActual)
                ->whereYear('fecha_venta', $añoActual)
                ->sum('monto_total');
            
            // Calcular total histórico de ventas
            $totalHistorico = DB::table('venta')
                ->sum('monto_total');
                
            // Obtener ventas pendientes de pago
            $ventasPendientes = DB::table('venta')
                ->where('estado_pago', 0)
                ->count();
            
            return view('homeApp', [
                'ventasPorMes' => json_encode($ventasPorMes),
                'ventasMesActual' => $ventasMesActual,
                'totalHistorico' => $totalHistorico,
                'ventasPendientes' => $ventasPendientes,
                'mesActualNombre' => $this->getNombreMes($mesActual),
                'añoActual' => $añoActual
            ]);
        } catch (\Exception $e) {
            \Log::error("Error en HomeController: " . $e->getMessage());
            return view('homeApp', [
                'ventasPorMes' => json_encode([]),
                'ventasMesActual' => 0,
                'ventasPendientes' => 0,
                'error' => 'No se pudieron cargar los datos correctamente'
            ]);
        }
    }
    
    /**
     * Obtener datos de ventas agrupados por mes
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

    private function getNombreMes($mes) {
        $nombresMeses = [
            1 => 'Enero', 2 => 'Febrero', 3 => 'Marzo', 4 => 'Abril',
            5 => 'Mayo', 6 => 'Junio', 7 => 'Julio', 8 => 'Agosto',
            9 => 'Septiembre', 10 => 'Octubre', 11 => 'Noviembre', 12 => 'Diciembre'
        ];
        
        return $nombresMeses[$mes] ?? '';
    }
}
