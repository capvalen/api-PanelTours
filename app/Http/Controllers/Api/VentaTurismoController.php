<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\VentaTurismo;
use Illuminate\Http\Request;

class VentaTurismoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return VentaTurismo::orderBy('id', 'desc')->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $item = VentaTurismo::create($request->all());
        return response()->json(["message" => "VentaTurismo creado correctamente", "data" => $item]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return VentaTurismo::find($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $item = VentaTurismo::findOrFail($id);
        $item->update($request->all());
        return response()->json(["message" => "VentaTurismo actualizado correctamente", "data" => $item]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $item = VentaTurismo::findOrFail($id);
        if (isset($item->activo)) {
            $item->update(['activo' => 0]);
        } else {
            $item->delete();
        }
        return response()->json(["message" => "VentaTurismo eliminado"]);
    }
}
