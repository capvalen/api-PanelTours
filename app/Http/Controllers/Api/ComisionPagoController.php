<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ComisionPago;
use Illuminate\Http\Request;

class ComisionPagoController extends Controller
{
    public function index(Request $request)
    {
        $query = ComisionPago::with('comision');

        if ($request->filled('comision_id')) {
            $query->where('comision_id', $request->comision_id);
        }

        if ($request->filled('limite')) {
            $query->limit($request->limite);
        }

        return $query->orderBy('fecha', 'desc')->get();
    }

    public function store(Request $request)
    {
        $item = ComisionPago::create($request->all());
        return response()->json($item, 201);
    }

    public function show(string $id)
    {
        return ComisionPago::with('comision')->findOrFail($id);
    }

    public function update(Request $request, string $id)
    {
        $item = ComisionPago::findOrFail($id);
        $item->update($request->all());
        return response()->json($item);
    }

    public function destroy(string $id)
    {
        $item = ComisionPago::findOrFail($id);
        $item->update(['activo' => 0]);
        return response()->json(['message' => 'Pago de comisión eliminado']);
    }
}
