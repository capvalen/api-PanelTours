<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Restaurante;
use Illuminate\Http\Request;

class RestauranteController extends Controller
{
	/**
	 * Display a listing of the resource.
	 */
	public function index(Request $request)
	{
		$buscar = $request->buscar;
		$query = Restaurante::orderBy('id', 'desc');

		if ($request->has('buscar')) {
			$query->where(function ($q) use ($buscar) {
			//se crea una sub query
			$q->where('nombre', 'like', '%'.$buscar . '%')
				->orWhere('ruc', 'like', '%'.$buscar . '%');
			});
		}

		$restaurantes = $query->where('activo', 1)->get();
		return response()->json($restaurantes);
	}

	/**
	 * Store a newly created resource in storage.
	 */
	public function store(Request $request)
	{
		$item = Restaurante::create($request->all());
		return response()->json($item);
	}

	/**
	 * Display the specified resource.
	 */
	public function show(string $id)
	{
		return Restaurante::find($id);
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update(Request $request, string $id)
	{
		$item = Restaurante::findOrFail($id);
		$item->update($request->all());
		return $item;
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(string $id)
	{
		$item = Restaurante::findOrFail($id);
		if (isset($item->activo)) {
			$item->update(['activo' => 0]);
		} else {
			$item->delete();
		}
		return response()->json(["message" => "Restaurante eliminado"]);
	}
}
