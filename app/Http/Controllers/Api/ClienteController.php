<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Cliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClienteController extends Controller
{
		/**
		 * Display a listing of the resource.
		 */
		public function index(Request $request)
		{
			$buscar = $request->buscar;
			$query = Cliente::where('activo', 1);

			if ($request->has('buscar')) {
				$query->where(function ($q) use ($buscar) {
					//se crea una sub query
					$q->where('dni', $buscar)
						->orWhere('ruc', $buscar)
						->orWhere(DB::raw("CONCAT(apellidos, ' ', nombres)"), 'like', '%'.$buscar . '%')
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
				$item = Cliente::create($request->all());
				return $item;
		}

		/**
		 * Display the specified resource.
		 */
		public function show(string $id)
		{
				return Cliente::find($id);
		}

		/**
		 * Update the specified resource in storage.
		 */
		public function update(Request $request, string $id)
		{
				$item = Cliente::findOrFail($id);
				$item->update($request->all());
				return $item;
		}

		/**
		 * Remove the specified resource from storage.
		 */
		public function destroy(string $id)
		{
				$item = Cliente::findOrFail($id);
				if (isset($item->activo)) {
						$item->update(['activo' => 0]);
				} else {
						$item->delete();
				}
				return response()->json(["message" => "Cliente eliminado"]);
		}
}
