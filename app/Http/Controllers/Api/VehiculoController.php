<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Vehiculo;
use Illuminate\Http\Request;

class VehiculoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
      $buscar = $request->buscar;
			$query = Vehiculo::where('activo', 1);
			

			if ($request->has('buscar')) {
				$query->where(function ($q) use ($buscar) {
					//se crea una sub query
					$q->where('nombre_conductor', 'like', '%'.$buscar . '%')
						->orWhere('dni_conductor', 'like', '%'.$buscar . '%')
						->orWhere('licencia_conductor', 'like', '%'.$buscar . '%')
						->orWhere('placa', 'like', '%'.$buscar . '%');
        });
			}

			return $query->orderBy('id', 'desc')->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $item = Vehiculo::create($request->all());
        return response()->json($item);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return Vehiculo::find($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $item = Vehiculo::findOrFail($id);
        $item->update($request->all());
        return $item;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $item = Vehiculo::findOrFail($id);
        if (isset($item->activo)) {
            $item->update(['activo' => 0]);
        } else {
            $item->delete();
        }
        return response()->json(["message" => "Vehiculo eliminado"]);
    }
}
