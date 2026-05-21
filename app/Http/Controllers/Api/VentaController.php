<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Venta;
use App\Models\VentaAuto;
use App\Models\VentaHospedaje;
use App\Models\VentaItem;
use App\Models\VentaRestaurante;
use App\Models\VentaTurismo;
use App\Models\VentaVuelo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VentaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Venta::orderBy('id', 'desc')
        ->with('items', 'departamento')
        ->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
      $canasta = $request->input('canasta');
      $ventaData = $request->input('venta', []);
      if (array_key_exists('personas', $ventaData) && !array_key_exists('cuantas_personas', $ventaData)) {
        $ventaData['cuantas_personas'] = $ventaData['personas'];
      }
      unset($ventaData['personas']);

      $venta = Venta::create($ventaData);

      // Registrar acción en la tabla de seguimiento
      $accion = \App\Models\Accion::where('nombre', 'cotización generada')->first();
      if ($accion) {
          \App\Models\Seguimiento::create([
              'venta_id' => $venta->id,
              'accion_id' => $accion->id,
              'fecha' => now(),
              'id_usuario' => $venta->usuario_id ?? 1,
          ]);
      }

      foreach ($canasta as $item) {
        $item['resumen']['venta_id'] = $venta->id;
        //var_dump($item); die();
        $ventaItem = VentaItem::create($item['resumen']);
        $item['venta_item_id'] = $ventaItem->id;
        
        switch ($item['tipo']) {
          case 'restaurante':
            VentaRestaurante::create($item);
            break;
          case 'vuelo':
            VentaVuelo::create($item);
            break;
          case 'hospedaje':
            VentaHospedaje::create($item);
            break;
          case 'transporte':
            VentaAuto::create($item);
            break;
          case 'tour':
            VentaTurismo::create($item);
            break;
          default:
            # code...
            break;
        }


      }
      
        // foreach ($request->input('canasta')as $item) {
        //   switch ($item['tipo']) {
        //     case 'restaurante':
        //       $itemConVentaId = array_merge($item, ['venta_id' => $venta->id]);
        //       VentaRestaurante::create($itemConVentaId);
        //       break;
            
        //     default:
        //       # code...
        //       break;
        //   }
        // }
        return response()->json($venta);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return Venta::findOrFail($id)->load('items', 'pagos', 'departamento', 'personas', 'seguimientos.accion');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $item = Venta::findOrFail($id);
        $ventaData = $request->input('venta');
        $data = is_array($ventaData) ? $ventaData : $request->all();
        if (array_key_exists('personas', $data) && !array_key_exists('cuantas_personas', $data)) {
            $data['cuantas_personas'] = $data['personas'];
        }
        unset($data['personas']);

        $progresoAnterior = $item->progreso;
        DB::transaction(function () use ($request, $item, $data) {
            $item->update($data);

            if ($request->has('canasta') && is_array($request->input('canasta'))) {
                $canasta = $request->input('canasta', []);
                $ventaItemIds = $item->items()->withoutGlobalScopes()->pluck('id');

                if ($ventaItemIds->isNotEmpty()) {
                    VentaRestaurante::whereIn('venta_item_id', $ventaItemIds)->delete();
                    VentaVuelo::whereIn('venta_item_id', $ventaItemIds)->delete();
                    VentaHospedaje::whereIn('venta_item_id', $ventaItemIds)->delete();
                    VentaAuto::whereIn('venta_item_id', $ventaItemIds)->delete();
                    VentaTurismo::whereIn('venta_item_id', $ventaItemIds)->delete();
                    VentaItem::withoutGlobalScopes()->whereIn('id', $ventaItemIds)->delete();
                }

                foreach ($canasta as $canastaItem) {
                    $resumen = is_array($canastaItem['resumen'] ?? null) ? $canastaItem['resumen'] : [];
                    $resumen['venta_id'] = $item->id;
                    $ventaItem = VentaItem::create($resumen);

                    $canastaItem['venta_item_id'] = $ventaItem->id;
                    switch ($canastaItem['tipo'] ?? null) {
                        case 'restaurante':
                            VentaRestaurante::create($canastaItem);
                            break;
                        case 'vuelo':
                            VentaVuelo::create($canastaItem);
                            break;
                        case 'hospedaje':
                            VentaHospedaje::create($canastaItem);
                            break;
                        case 'transporte':
                            VentaAuto::create($canastaItem);
                            break;
                        case 'tour':
                            VentaTurismo::create($canastaItem);
                            break;
                        default:
                            break;
                    }
                }
            }
        });

        if ($request->has('progreso') && $request->input('progreso') !== $progresoAnterior) {
            $progreso = $request->input('progreso');
            $nombreAccion = "cambio de estado a " . $progreso;
            $accion = \App\Models\Accion::firstOrCreate(['nombre' => $nombreAccion]);
            
            \App\Models\Seguimiento::create([
                'venta_id' => $item->id,
                'accion_id' => $accion->id,
                'fecha' => now(),
                'id_usuario' => $item->usuario_id ?? 1,
            ]);
        }

        return $item->fresh()->load('items', 'pagos', 'departamento', 'personas', 'seguimientos.accion');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id, Request $request)
    {
        $item = Venta::findOrFail($id);

			// Registrar acción en la tabla de seguimiento
      $accion = \App\Models\Accion::where('nombre', 'venta eliminada')->first();
      if ($accion) {
          \App\Models\Seguimiento::create([
              'venta_id' => $item->id,
              'accion_id' => $accion->id,
              'fecha' => now(),
              'id_usuario' => $venta->usuario_id ?? 1,
          ]);
      }
				
				if ($request->has('anular')){
					$item->update(['estado' => 'anulado']);
				}else{
					if (isset($item->activo)) {
							$item->update(['activo' => 0]);
					} else {
							$item->delete();
					}
				}

        return response()->json(["message" => "Venta eliminado"]);
    }
}
