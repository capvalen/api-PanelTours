<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Departamento;
use Illuminate\Http\Request;

class DepartamentoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Departamento::orderBy('id', 'desc')->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $item = Departamento::create($request->all());
        return response()->json(["message" => "Departamento creado correctamente", "data" => $item]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return Departamento::find($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $item = Departamento::findOrFail($id);
        $item->update($request->all());
        return response()->json(["message" => "Departamento actualizado correctamente", "data" => $item]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $item = Departamento::findOrFail($id);
        if (isset($item->activo)) {
            $item->update(['activo' => 0]);
        } else {
            $item->delete();
        }
        return response()->json(["message" => "Departamento eliminado"]);
    }
}
