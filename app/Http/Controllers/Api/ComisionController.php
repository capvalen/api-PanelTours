<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Comision;
use Illuminate\Http\Request;

class ComisionController extends Controller
{
    public function index(Request $request)
    {
        $query = Comision::with('pagos');

        if ($request->filled('buscar')) {
            $buscar = $request->buscar;
            $query->where(function ($q) use ($buscar) {
                $q->whereHas('venta', function ($qv) use ($buscar) {
                    $qv->where('id', 'like', "%$buscar%");
                })->orWhereHas('comisionable', function ($qc) use ($buscar) {
                    $qc->where('nombre', 'like', "%$buscar%");
                });
            });
        }

        if ($request->filled('fecha')) {
            $query->whereDate('fecha', $request->fecha);
        }

        if ($request->filled('venta_id')) {
            $query->where('venta_id', $request->venta_id);
        }

        if ($request->filled('estado_pago')) {
            $estados = explode(',', $request->estado_pago);
            $query->whereIn('estado_pago', $estados);
        }

        if ($request->filled('tipo')) {
            $query->where('comisionable_type', 'App\\Models\\' . ucfirst($request->tipo));
        }

        if ($request->filled('comisionable_id')) {
            $query->where('comisionable_id', $request->comisionable_id);
        }

        if ($request->filled('limite')) {
            $query->limit($request->limite);
        }

        return $query->orderBy('id', 'desc')->get();
    }

    public function store(Request $request)
    {
        $item = Comision::create($request->all());
        return response()->json($item, 201);
    }

    public function show(string $id)
    {
        return Comision::with('pagos', 'venta', 'comisionable')->findOrFail($id);
    }

    public function update(Request $request, string $id)
    {
        $item = Comision::findOrFail($id);
        $item->update($request->all());
        return response()->json($item);
    }

    public function destroy(string $id)
    {
        $item = Comision::findOrFail($id);
        $item->update(['activo' => 0]);
        return response()->json(['message' => 'Comisión eliminada']);
    }
}
