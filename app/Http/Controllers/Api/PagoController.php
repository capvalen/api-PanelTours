<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Pago;
use App\Models\Venta;
use App\Models\Caja;
use App\Models\CajaDetalle;
use Illuminate\Http\Request;

class PagoController extends Controller
{
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
        $estadoPago = $nuevoAdelanto >= $venta->precio ? 'completo' : 'adelanto';
        
        $venta->update([
            'adelanto' => $nuevoAdelanto,
            'estado_pago' => $estadoPago
        ]);

        // Registrar en caja detalles
        $cajaAbierta = Caja::where('estado', 'abierta')->first();
        if ($cajaAbierta) {
            CajaDetalle::create([
                'caja_id' => $cajaAbierta->id,
                'tipo' => 'ingreso',
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
        $estadoPago = $nuevoAdelanto >= $venta->precio ? 'completo' : ($nuevoAdelanto > 0 ? 'adelanto' : 'pendiente');

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
        $estadoPago = $nuevoAdelanto >= $venta->precio ? 'completo' : ($nuevoAdelanto > 0 ? 'adelanto' : 'pendiente');

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
}
