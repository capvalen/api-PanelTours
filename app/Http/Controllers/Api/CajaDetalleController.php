<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\CajaDetalle;
use Illuminate\Http\Request;

class CajaDetalleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
      $query = CajaDetalle::orderBy('id', 'desc');
			if ($request->has('caja_id')) {
				$query->where('caja_id', $request->caja_id);
			}
			return $query->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $item = CajaDetalle::create($request->all());
        return response()->json(["message" => "CajaDetalle creado correctamente", "data" => $item]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return CajaDetalle::find($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $item = CajaDetalle::findOrFail($id);
        $item->update($request->all());
        return response()->json(["message" => "CajaDetalle actualizado correctamente", "data" => $item]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $item = CajaDetalle::findOrFail($id);
        if (isset($item->activo)) {
            $item->update(['activo' => 0]);
        } else {
            $item->delete();
        }
        return response()->json(["message" => "CajaDetalle eliminado"]);
    }
}
