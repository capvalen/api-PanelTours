<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Caja;
use Illuminate\Http\Request;

class CajaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Caja::orderBy('id', 'desc')->take(50);

				if ($request->has('fecha')) {
					$query->whereDate('fecha_apertura', $request->fecha);
        }
				//URL: http://127.0.0.1:8000/api/cajas?abierta=true
				if ($request->has('abierta')) {
					$query->where('estado', 'abierta');
        }
				$cajas = $query->with('usuario')->get();
				return $cajas; 
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
			//return $request->all();
			$otrasCajas = Caja::where('estado', 'abierta');
			$otrasCajas->update(['estado' => 'cerrada']);

			$item = Caja::create($request->all());
			$item->load('usuario');
			$item->load('detalle');

			return response()->json([
				"message" => "Caja aperturada correctamente",
				"data" => $item
			]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return Caja::find($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $item = Caja::findOrFail($id);
        $item->update($request->all());
        return response()->json(["message" => "Caja actualizado correctamente", "data" => $item]);
    }

    public function cerrar(Request $request, string $id)
    {
			//url= http://127.0.0.1:8000/api/cajas/1/cerrar
			$item = Caja::findOrFail($id);
			$item->update($request->all());
			$item->update([
				'estado' => 'cerrada',
				'fecha_cierre' => now()
			]);
			return response()->json(["message" => "Caja cerrada correctamente", "data" => $item]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $item = Caja::findOrFail($id);
        if (isset($item->activo)) {
            $item->update(['activo' => 0]);
        } else {
            $item->delete();
        }
        return response()->json(["message" => "Caja eliminado"]);
    }
}
