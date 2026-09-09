<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Pago;
use App\Models\Venta;
use App\Models\Caja;
use App\Models\CajaDetalle;
use App\Models\Comision;
use App\Models\CobroAbono;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class PagoController extends Controller
{
    /**
     * Lista todos los pagos: pagos de ventas y cobros de proveedores (tabla pagos)
     * más las comisiones (tabla comisiones) como egresos por pagar.
     */
    public function indexTodos(Request $request)
    {
        // ── Pagos de ventas y cobros de proveedores ──
        $pagos = Pago::with('venta.cliente', 'proveedor');

        if ($request->filled('es_cobro')) {
            $pagos->where('es_cobro', filter_var($request->es_cobro, FILTER_VALIDATE_BOOLEAN));
        }

        if ($request->filled('proveedor_id')) {
            $pagos->where(function ($q) use ($request) {
                // Cobros del proveedor
                $q->where('proveedor_id', $request->proveedor_id)
                    // Pagos de ventas donde el proveedor es vendedor
                    ->orWhere(function ($q2) use ($request) {
                        $q2->where('es_cobro', false)
                            ->whereHas('venta', fn ($qv) => $qv->where('vendedor_id', $request->proveedor_id));
                    });
            });
        }

        if ($request->filled('estado_pago')) {
            $pagos->where('estado_pago', $request->estado_pago);
        }

        if ($request->filled('fecha')) {
            $pagos->whereDate('fecha', $request->fecha);
        }

        if ($request->filled('buscar')) {
            $buscar = $request->buscar;
            $pagos->where(function ($q) use ($buscar) {
                $q->where('codigo_referencia', 'like', "%$buscar%")
                    ->orWhereHas('proveedor', fn ($qp) => $qp->where('razon_social', 'like', "%$buscar%"))
                    ->orWhereHas('venta.cliente', fn ($qc) => $qc->where('nombres', 'like', "%$buscar%")->orWhere('apellidos', 'like', "%$buscar%"));
            });
        }

        $pagosList = $pagos->orderBy('fecha', 'desc')->get()->map(fn ($p) => [
            'id' => $p->id,
            'origen' => 'pago',
            'fecha' => $p->fecha,
            'monto' => $p->monto_abonado,
            'saldo_pendiente' => $p->saldo_pendiente,
            'es_cobro' => (bool) $p->es_cobro,
            'estado_pago' => $p->estado_pago,
            'metodo_pago' => $p->metodo_pago,
            'codigo_referencia' => $p->codigo_referencia,
            'beneficiario' => $p->proveedor?->razon_social
                ?? ($p->venta?->cliente ? trim(($p->venta->cliente->nombres ?? '') . ' ' . ($p->venta->cliente->apellidos ?? '')) : null)
                ?? null,
            'concepto' => $p->concepto ?: ($p->proveedor ? 'Cobro a proveedor' : 'Pago de venta'),
            'venta_id' => $p->venta_id,
            'proveedor_id' => $p->proveedor_id,
        ]);

        // ── Comisiones (egresos por pagar) ──
        // Solo se incluyen cuando NO se filtra por es_cobro=true (las comisiones siempre son egresos)
        $incluirComisiones = !$request->filled('es_cobro') || !filter_var($request->es_cobro, FILTER_VALIDATE_BOOLEAN);

        $comisiones = Comision::with('comisionable', 'pagos');

        if ($request->filled('proveedor_id')) {
            $comisiones->where('comisionable_id', $request->proveedor_id)
                ->where('comisionable_type', 'App\\Models\\Proveedor');
        }

        if ($request->filled('fecha')) {
            $comisiones->whereDate('fecha', $request->fecha);
        }

        if ($request->filled('estado_pago')) {
            $comisiones->where('estado_pago', $request->estado_pago);
        }

        if ($request->filled('buscar')) {
            $buscar = $request->buscar;
            $comisiones->whereHas('comisionable', function ($q) use ($buscar) {
                $q->where('nombre', 'like', "%$buscar%")
                    ->orWhere('razon_social', 'like', "%$buscar%")
                    ->orWhere('nombre_conductor', 'like', "%$buscar%");
            });
        }

        $comisionList = $incluirComisiones
            ? $comisiones->orderBy('fecha', 'desc')->get()->map(function ($comision) {
                $comisionable = $comision->comisionable;
                $pagado = (float) $comision->pagos->sum('monto');
                $saldo = round(max(0, (float) $comision->monto - $pagado), 2);
                return [
                    'id' => $comision->id,
                    'origen' => 'comision',
                    'fecha' => $comision->fecha,
                    'monto' => $comision->monto,
                    'saldo_pendiente' => $saldo,
                    'es_cobro' => false,
                    'estado_pago' => $comision->estado_pago,
                    'metodo_pago' => null,
                    'codigo_referencia' => null,
                    'beneficiario' => $comisionable?->nombre
                        ?? $comisionable?->razon_social
                        ?? $comisionable?->nombre_conductor
                        ?? null,
                    'concepto' => 'Pago de comisión',
                    'comision_id' => $comision->id,
                ];
            })
            : collect();

        // Combinar y ordenar por fecha descendente
        $todos = $comisionList->concat($pagosList)->sortByDesc('fecha')->values();

        return response()->json($todos);
    }

    /**
     * Registra un cobro (ingreso) o pago por pagar (egreso) de un proveedor.
     * monto = total, monto_recibido = abono inicial (opcional).
     * es_cobro: true = cobro (ingreso), false = pago por pagar (egreso).
     */
    public function storeProveedor(Request $request)
    {
        $request->validate([
            'proveedor_id' => 'required|exists:proveedores,id',
            'monto' => 'required|numeric|min:0.01',
            'monto_recibido' => 'nullable|numeric|min:0',
            'fecha' => 'required|date',
            'es_cobro' => 'nullable|boolean',
            'concepto' => 'nullable|string',
            'metodo_pago' => 'nullable|string',
            'codigo_referencia' => 'nullable|string',
            'observaciones' => 'nullable|string',
        ]);

        $esCobro = $request->boolean('es_cobro', true);
        $total = (float) $request->monto;
        $recibido = (float) ($request->monto_recibido ?? 0);
        $recibido = min($recibido, $total);
        $saldo = round($total - $recibido, 2);
        $estado = $saldo <= 0 ? 'pagado' : ($recibido > 0 ? 'adelantado' : 'pendiente');

        $item = Pago::create([
            'venta_id' => null,
            'proveedor_id' => $request->proveedor_id,
            'fecha' => $request->fecha,
            'es_compromiso' => false,
            'monto_abonado' => $recibido,
            'saldo_pendiente' => $saldo,
            'metodo_pago' => $request->metodo_pago ?? 'efectivo',
            'estado_pago' => $estado,
            'es_cobro' => $esCobro,
            'codigo_referencia' => $request->codigo_referencia,
            'concepto' => $request->concepto,
            'activo' => true,
        ]);

        // Registrar en caja (ingreso si es cobro, egreso si es pago por pagar)
        if ($recibido > 0) {
            $cajaAbierta = Caja::where('estado', 'abierta')->first();
            if ($cajaAbierta) {
                CajaDetalle::create([
                    'caja_id' => $cajaAbierta->id,
                    'tipo' => $esCobro ? 'ingreso' : 'egreso',
                    'categoria' => $esCobro ? 'cobro a proveedor' : 'pago de proveedores',
                    'monto' => $recibido,
                    'concepto' => $request->concepto ?: ($esCobro ? 'Cobro a proveedor' : 'Pago a proveedor'),
                    'fecha' => now(),
                    'comprobante_pago' => 'interno',
                    'proveedor_id' => $request->proveedor_id,
                    'metodo_pago' => $request->metodo_pago ?? 'efectivo',
                    'estado_pago' => 'pagado',
                ]);
            }

            // Registrar abono inicial en el historial (solo cobros)
            if ($esCobro) {
                CobroAbono::create([
                    'cobro_id' => $item->id,
                    'fecha' => $request->fecha,
                    'monto' => $recibido,
                    'metodo_pago' => $request->metodo_pago ?? 'efectivo',
                    'codigo_referencia' => $request->codigo_referencia,
                    'observaciones' => $request->observaciones,
                ]);
            }
        }

        return response()->json($item, 201);
    }

    /**
     * Muestra un cobro de proveedor con su historial de abonos.
     */
    public function showCobro(int $id)
    {
        return Pago::with('proveedor', 'abonos')->findOrFail($id);
    }

    /**
     * Registra un abono (adelanto o saldo total) a un cobro de proveedor.
     * También permite actualizar los archivos adjuntos (sin monto).
     */
    public function abonarCobro(Request $request, int $id)
    {
        $request->validate([
            'monto' => 'nullable|numeric|min:0.01',
            'archivos' => 'nullable|array',
            'metodo_pago' => 'nullable|string',
            'codigo_referencia' => 'nullable|string',
            'observaciones' => 'nullable|string',
        ]);

        $item = Pago::where('es_cobro', true)->findOrFail($id);

        // Solo actualización de archivos adjuntos
        if ($request->filled('archivos') && !$request->filled('monto')) {
            $item->update(['archivos' => $request->archivos]);
            return response()->json($item);
        }

        $abono = (float) $request->monto;
        $nuevoAbonado = round((float) $item->monto_abonado + $abono, 2);
        $nuevoSaldo = round(max(0, (float) $item->saldo_pendiente - $abono), 2);
        $nuevoEstado = $nuevoSaldo <= 0 ? 'pagado' : 'adelantado';

        $item->update([
            'monto_abonado' => $nuevoAbonado,
            'saldo_pendiente' => $nuevoSaldo,
            'estado_pago' => $nuevoEstado,
            'metodo_pago' => $request->metodo_pago ?? $item->metodo_pago,
            'codigo_referencia' => $request->codigo_referencia ?? $item->codigo_referencia,
        ]);

        // Registrar en caja como ingreso
        $cajaAbierta = Caja::where('estado', 'abierta')->first();
        if ($cajaAbierta) {
            CajaDetalle::create([
                'caja_id' => $cajaAbierta->id,
                'tipo' => 'ingreso',
                'categoria' => 'cobro a proveedor',
                'monto' => $abono,
                'concepto' => $request->observaciones ?: 'Abono a cobro de proveedor',
                'fecha' => now(),
                'comprobante_pago' => 'interno',
                'proveedor_id' => $item->proveedor_id,
                'metodo_pago' => $request->metodo_pago ?? $item->metodo_pago,
                'estado_pago' => 'pagado',
            ]);
        }

        // Registrar abono en el historial
        CobroAbono::create([
            'cobro_id' => $item->id,
            'fecha' => now()->toDateString(),
            'monto' => $abono,
            'metodo_pago' => $request->metodo_pago ?? $item->metodo_pago,
            'codigo_referencia' => $request->codigo_referencia,
            'observaciones' => $request->observaciones,
        ]);

        $item->load('abonos');

        return response()->json($item);
    }

    /**
     * Muestra un pago por pagar de proveedor con su historial de abonos.
     */
    public function showPagoPagar(int $id)
    {
        return Pago::with('proveedor', 'abonos')->where('es_cobro', false)->findOrFail($id);
    }

    /**
     * Registra un abono (adelanto o saldo total) a un pago por pagar de proveedor.
     * También permite actualizar los archivos adjuntos (sin monto).
     */
    public function abonarPagoPagar(Request $request, int $id)
    {
        $request->validate([
            'monto' => 'nullable|numeric|min:0.01',
            'archivos' => 'nullable|array',
            'metodo_pago' => 'nullable|string',
            'codigo_referencia' => 'nullable|string',
            'observaciones' => 'nullable|string',
        ]);

        $item = Pago::where('es_cobro', false)->findOrFail($id);

        // Solo actualización de archivos adjuntos
        if ($request->filled('archivos') && !$request->filled('monto')) {
            $item->update(['archivos' => $request->archivos]);
            return response()->json($item);
        }

        $abono = (float) $request->monto;
        $nuevoAbonado = round((float) $item->monto_abonado + $abono, 2);
        $nuevoSaldo = round(max(0, (float) $item->saldo_pendiente - $abono), 2);
        $nuevoEstado = $nuevoSaldo <= 0 ? 'pagado' : 'adelantado';

        $item->update([
            'monto_abonado' => $nuevoAbonado,
            'saldo_pendiente' => $nuevoSaldo,
            'estado_pago' => $nuevoEstado,
            'metodo_pago' => $request->metodo_pago ?? $item->metodo_pago,
            'codigo_referencia' => $request->codigo_referencia ?? $item->codigo_referencia,
        ]);

        // Registrar en caja como egreso
        $cajaAbierta = Caja::where('estado', 'abierta')->first();
        if ($cajaAbierta) {
            CajaDetalle::create([
                'caja_id' => $cajaAbierta->id,
                'tipo' => 'egreso',
                'categoria' => 'pago de proveedores',
                'monto' => $abono,
                'concepto' => $request->observaciones ?: 'Abono a pago por pagar de proveedor',
                'fecha' => now(),
                'comprobante_pago' => 'interno',
                'proveedor_id' => $item->proveedor_id,
                'metodo_pago' => $request->metodo_pago ?? $item->metodo_pago,
                'estado_pago' => 'pagado',
            ]);
        }

        // Registrar abono en el historial
        CobroAbono::create([
            'cobro_id' => $item->id,
            'fecha' => now()->toDateString(),
            'monto' => $abono,
            'metodo_pago' => $request->metodo_pago ?? $item->metodo_pago,
            'codigo_referencia' => $request->codigo_referencia,
            'observaciones' => $request->observaciones,
        ]);

        $item->load('abonos');

        return response()->json($item);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(int $idVenta)
    {
        return Pago::where('venta_id', $idVenta)->orderBy('id', 'desc')->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, int $idVenta)
    {
        $venta = Venta::findOrFail($idVenta);
        $data = $request->all();
        $data['venta_id'] = $idVenta;
        $item = Pago::create($data);
        $nuevoAdelanto = (float) $venta->adelanto + (float) $item->monto_abonado;
        $estadoPago = $nuevoAdelanto >= $venta->precio ? 'pagado' : 'adelantado';
        
        $venta->update([
            'adelanto' => $nuevoAdelanto,
            'estado_pago' => $estadoPago
        ]);

        // Registrar en caja detalles
        $cajaAbierta = Caja::where('estado', 'abierta')->first();
        if ($cajaAbierta) {
            CajaDetalle::create([
                'caja_id' => $cajaAbierta->id,
                'tipo' => $item->es_cobro ? 'ingreso' : 'egreso',
                'categoria' => 'venta',
                'monto' => $item->monto_abonado,
                'concepto' => $data['concepto'] ?: 'Pago de venta #' . $idVenta,
                'fecha' => now(),
                'comprobante_pago' => 'interno',
                'venta_id' => $idVenta,
                'metodo_pago' => $item->metodo_pago,
                'estado_pago' => $estadoPago,
                'proveedor_id' => 1,
            ]);
        }

        // Registrar acción en la tabla de seguimiento
        $accion = \App\Models\Accion::firstOrCreate(['nombre' => 'pago realizado']);
        \App\Models\Seguimiento::create([
            'venta_id' => $idVenta,
            'accion_id' => $accion->id,
            'fecha' => now(),
            'id_usuario' => $venta->usuario_id ?? 1,
        ]);

        $item = Pago::findOrFail($item->id);

        return response()->json($item);
    }

    /**
     * Display the specified resource.
     */
    public function show(int $idVenta, string $id)
    {
        return Pago::where('venta_id', $idVenta)->findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $idVenta, string $id)
    {
        $item = Pago::where('venta_id', $idVenta)->findOrFail($id);
        $venta = Venta::findOrFail($idVenta);

        $montoAnterior = (float) $item->monto_abonado;
        $item->update($request->all());
        $montoNuevo = (float) $item->monto_abonado;

        $nuevoAdelanto = (float) $venta->adelanto - $montoAnterior + $montoNuevo;
        $estadoPago = $nuevoAdelanto >= $venta->precio ? 'pagado' : ($nuevoAdelanto > 0 ? 'adelantado' : 'pendiente');

        $venta->update([
            'adelanto' => $nuevoAdelanto,
            'estado_pago' => $estadoPago
        ]);

        return response()->json($item);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $idVenta, int $id)
    {
        $item = Pago::findOrFail($id);
        $venta = Venta::findOrFail($idVenta);

        $nuevoAdelanto = (float) $venta->adelanto - (float) $item->monto_abonado;
        $estadoPago = $nuevoAdelanto >= $venta->precio ? 'pagado' : ($nuevoAdelanto > 0 ? 'adelantado' : 'pendiente');

        $venta->update([
            'adelanto' => $nuevoAdelanto,
            'estado_pago' => $estadoPago
        ]);
        
        $item->update(['activo' => 0]);

        // Registrar acción en la tabla de seguimiento
        $accion = \App\Models\Accion::firstOrCreate(['nombre' => 'pago anulado']);
        \App\Models\Seguimiento::create([
            'venta_id' => $idVenta,
            'accion_id' => $accion->id,
            'fecha' => now(),
            'id_usuario' => $venta->usuario_id ?? 1,
        ]);
        
        return response()->json(["message" => "Pago eliminado"]);
    }

    public function generarTicketPdf(string $token)
    {
        $decoded = base64_decode($token);
        $json = strrev($decoded);
        $data = json_decode($json, true);
        $idVenta = $data['idVenta'] ?? null;
        $id = $data['pago'] ?? null;
        if (!$idVenta || !$id) {
            return response()->json(['error' => 'Parámetro inválido'], 400);
        }
        $pago = Pago::withoutGlobalScope('activo')->where('venta_id', $idVenta)->findOrFail($id);
        $venta = $pago->venta;
        $cliente = $venta->cliente;
        $items = $venta->items;
        $codigo = 'TICKET-' . str_pad($pago->id, 3, '0', STR_PAD_LEFT);
        $ventaCodigo = 'GEA-' . str_pad($venta->id, 3, '0', STR_PAD_LEFT);

        $logoPath = public_path('images/logo.webp');
        $logoBase64 = '';
        if (file_exists($logoPath)) {
            $img = imagecreatefromwebp($logoPath);
            if ($img) {
                imagefilter($img, IMG_FILTER_GRAYSCALE);
                ob_start();
                imagewebp($img);
                $logoBase64 = base64_encode(ob_get_clean());
                imagedestroy($img);
            }
        }

        $data = [
            'pago' => $pago,
            'venta' => $venta,
            'cliente' => $cliente,
            'items' => $items,
            'codigo' => $codigo,
            'ventaCodigo' => $ventaCodigo,
            'logoBase64' => $logoBase64,
        ];

        $pdf = Pdf::loadView('pdf.ticket-pago', $data);
        $pdf->setPaper([0, 0, 226.77, 500], 'portrait');

        return $pdf->stream("{$codigo}.pdf");
    }
}
