<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\VentaGuia;
use Illuminate\Http\Request;

class VentaGuiaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return VentaGuia::orderBy('id', 'desc')->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $item = VentaGuia::create($request->all());
        return response()->json(["message" => "VentaGuia creado correctamente", "data" => $item]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return VentaGuia::find($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $item = VentaGuia::findOrFail($id);
        $item->update($request->all());
        return response()->json(["message" => "VentaGuia actualizado correctamente", "data" => $item]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $item = VentaGuia::findOrFail($id);
        if (isset($item->activo)) {
            $item->update(['activo' => 0]);
        } else {
            $item->delete();
        }
        return response()->json(["message" => "VentaGuia eliminado"]);
    }
}
