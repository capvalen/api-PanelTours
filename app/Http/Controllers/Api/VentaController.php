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
      $venta = Venta::create($request->input('venta'));

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
        return Venta::findOrFail($id)->load('items', 'pagos', 'departamento');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $item = Venta::findOrFail($id);
        $item->update($request->all());
        return $item;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id, Request $request)
    {
        $item = Venta::findOrFail($id);
				
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
