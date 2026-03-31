<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Proveedor;
use Illuminate\Http\Request;

class ProveedorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
			$buscar = $request->buscar;
			$query = Proveedor::where('activo', 1);
			

			if ($request->has('buscar')) {
				$query->where(function ($q) use ($buscar) {
					//se crea una sub query
					$q->where('ruc', $buscar)
						->orWhere('razon_social', 'like', $buscar . '%');
        });
			}

			return $query->orderBy('id', 'desc')->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $item = Proveedor::create($request->all());
        return response()->json($item);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return Proveedor::with('deudas')->find($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $item = Proveedor::with('deudas')->findOrFail($id);
        $item->update($request->all());
				return $item;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $item = Proveedor::findOrFail($id);
        if (isset($item->activo)) {
            $item->update(['activo' => 0]);
        } else {
            $item->delete();
        }
        return response()->json(["message" => "Proveedor eliminado"]);
    }
}
