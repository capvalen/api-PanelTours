<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Cotizacion;
use App\Models\CotizacionItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CotizacionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Cotizacion::orderBy('id', 'desc')
            ->with('items', 'departamento')
            ->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $canasta = $request->input('canasta', []);
        $cotizacionData = $request->input('venta', []); // Manteniendo compatibilidad con la estructura que envíe el cliente
        
        if (empty($cotizacionData)) {
            $cotizacionData = $request->input('cotizacion', []);
        }
        if (empty($cotizacionData)) {
            $cotizacionData = $request->all();
        }

        if (array_key_exists('personas', $cotizacionData) && !array_key_exists('cuantas_personas', $cotizacionData)) {
            $cotizacionData['cuantas_personas'] = $cotizacionData['personas'];
        }
        unset($cotizacionData['personas']);

        $cotizacion = Cotizacion::create($cotizacionData);

        foreach ($canasta as $item) {
            $resumen = $item['resumen'] ?? $item;
            $resumen['cotizacion_id'] = $cotizacion->id;
            
            // Si el cliente envía descuento y motivo_descuento en el item
            if (isset($item['descuento'])) {
                $resumen['descuento'] = $item['descuento'];
            }
            if (isset($item['motivo_descuento'])) {
                $resumen['motivo_descuento'] = $item['motivo_descuento'];
            }

            CotizacionItem::create($resumen);
        }

        return response()->json($cotizacion);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return Cotizacion::findOrFail($id)->load('items', 'departamento');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $cotizacion = Cotizacion::findOrFail($id);
        $cotizacionData = $request->input('venta');
        
        if (empty($cotizacionData)) {
            $cotizacionData = $request->input('cotizacion');
        }
        
        $data = is_array($cotizacionData) ? $cotizacionData : $request->all();
        
        if (array_key_exists('personas', $data) && !array_key_exists('cuantas_personas', $data)) {
            $data['cuantas_personas'] = $data['personas'];
        }
        unset($data['personas']);

        DB::transaction(function () use ($request, $cotizacion, $data) {
            $cotizacion->update($data);

            if ($request->has('canasta') && is_array($request->input('canasta'))) {
                $canasta = $request->input('canasta', []);
                $cotizacionItemIds = $cotizacion->items()->withoutGlobalScopes()->pluck('id');

                if ($cotizacionItemIds->isNotEmpty()) {
                    CotizacionItem::withoutGlobalScopes()->whereIn('id', $cotizacionItemIds)->delete();
                }

                foreach ($canasta as $canastaItem) {
                    $resumen = is_array($canastaItem['resumen'] ?? null) ? $canastaItem['resumen'] : $canastaItem;
                    $resumen['cotizacion_id'] = $cotizacion->id;

                    if (isset($canastaItem['descuento'])) {
                        $resumen['descuento'] = $canastaItem['descuento'];
                    }
                    if (isset($canastaItem['motivo_descuento'])) {
                        $resumen['motivo_descuento'] = $canastaItem['motivo_descuento'];
                    }

                    CotizacionItem::create($resumen);
                }
            }
        });

        return $cotizacion->fresh()->load('items', 'departamento');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id, Request $request)
    {
        $cotizacion = Cotizacion::findOrFail($id);

        if ($request->has('anular')) {
            $cotizacion->update(['estado' => 'anulado']);
        } else {
            if (isset($cotizacion->activo)) {
                $cotizacion->update(['activo' => 0]);
            } else {
                $cotizacion->delete();
            }
        }

        return response()->json(["message" => "Cotizacion eliminada"]);
    }
}
