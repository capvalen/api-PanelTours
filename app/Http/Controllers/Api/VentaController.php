<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Venta;
use App\Models\VentaItem;
use App\Models\VentaRestaurante;
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
      $venta = Venta::create($request->input('venta'));

      foreach ($request->input('venta_items') as $item) {
        $item['venta_id'] = $venta->id;
        VentaItem::create($item);
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
        return Venta::find($id);
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
