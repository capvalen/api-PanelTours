<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\VentaAutoPasajero;
use Illuminate\Http\Request;

class VentaAutoPasajeroController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return VentaAutoPasajero::orderBy('id', 'desc')->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $item = VentaAutoPasajero::create($request->all());
        return response()->json(["message" => "VentaAutoPasajero creado correctamente", "data" => $item]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return VentaAutoPasajero::find($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $item = VentaAutoPasajero::findOrFail($id);
        $item->update($request->all());
        return response()->json(["message" => "VentaAutoPasajero actualizado correctamente", "data" => $item]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $item = VentaAutoPasajero::findOrFail($id);
        if (isset($item->activo)) {
            $item->update(['activo' => 0]);
        } else {
            $item->delete();
        }
        return response()->json(["message" => "VentaAutoPasajero eliminado"]);
    }
}
