<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Caja;
use App\Models\CajaDetalle;
use App\Models\Venta;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Estadísticas del panel de administración.
     *
     * Se calcula en el servidor para no depender del perfil del usuario
     * (los endpoints /ventas y /cajas están restringidos por perfil) y para
     * usar la fecha de la aplicación (America/Lima) en lugar de UTC.
     */
    public function estadisticas()
    {
        $hoy = Carbon::today();
        $inicioMes = $hoy->copy()->startOfMonth();
        $finMes = $hoy->copy()->endOfMonth();

        // Estados de progreso que NO son ventas reales (cotizaciones)
        $progresosNoVenta = ['cotización', 'cotizacion'];

        // ── Ventas del día ──
        $ventasHoy = Venta::where('estado', '!=', 'anulado')
            ->whereDate('fecha', $hoy)
            ->whereNotIn('progreso', $progresosNoVenta);

        $ventasHoyCount = (clone $ventasHoy)->count();
        $montoVentasHoy = (float) (clone $ventasHoy)->sum('precio');

        // ── Pasajeros en ruta: solo los pasajeros de las ventas de hoy ──
        // Se usa cuantas_personas y, si está vacío, la suma de adultos + niños.
        $pasajerosEnRuta = (int) (clone $ventasHoy)->sum(DB::raw(
            'COALESCE(NULLIF(cuantas_personas, 0), COALESCE(adults, 0) + COALESCE(kids, 0))'
        ));

        // ── Ventas del mes ──
        $ventasMes = Venta::where('estado', '!=', 'anulado')
            ->whereNotIn('progreso', $progresosNoVenta)
            ->whereBetween('fecha', [$inicioMes->toDateString(), $finMes->toDateString()]);

        $ventasMesCount = (clone $ventasMes)->count();
        $montoVentasMes = (float) (clone $ventasMes)->sum('precio');

        // ── Caja: se usa la caja abierta; si no hay, la última del día ──
        $caja = Caja::where('estado', 'abierta')->latest('id')->first();

        if (!$caja) {
            $caja = Caja::whereDate('fecha_apertura', $hoy)->latest('id')->first();
        }

        $ingresosCaja = 0.0;
        $egresosCaja = 0.0;

        if ($caja) {
            $detalles = CajaDetalle::where('activo', 1)
                ->where('caja_id', $caja->id)
                ->get(['tipo', 'monto']);

            $ingresosCaja = (float) $detalles->where('tipo', 'ingreso')->sum('monto');
            $egresosCaja = (float) $detalles->where('tipo', 'egreso')->sum('monto');
        }

        $saldoCaja = $caja
            ? (float) $caja->monto_inicial + $ingresosCaja - $egresosCaja
            : 0.0;

        return response()->json([
            'ventas_hoy' => $ventasHoyCount,
            'monto_ventas_hoy' => $montoVentasHoy,
            'ventas_mes' => $ventasMesCount,
            'monto_ventas_mes' => $montoVentasMes,
            'pasajeros_en_ruta' => $pasajerosEnRuta,
            'ingresos_caja' => $ingresosCaja,
            'egresos_caja' => $egresosCaja,
            'saldo_caja' => $saldoCaja,
            'caja' => $caja ? [
                'id' => $caja->id,
                'estado' => $caja->estado,
                'monto_inicial' => (float) $caja->monto_inicial,
                'fecha_apertura' => $caja->fecha_apertura,
            ] : null,
        ]);
    }
}
