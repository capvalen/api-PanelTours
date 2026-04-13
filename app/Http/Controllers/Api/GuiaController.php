<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Guia;
use Illuminate\Http\Request;

class GuiaController extends Controller
{
		/**
		 * Display a listing of the resource.
		 */
		public function index(Request	$request)
		{
			$buscar = $request->buscar;
			$query = Guia::where('activo', 1);
			

			if ($request->has('buscar')) {
				$query->where(function ($q) use ($buscar) {
					//se crea una sub query
					$q->where('nombre', 'like', '%'.$buscar . '%')
						->orWhere('dni', 'like', '%'.$buscar . '%');
        });
			}

			return $query->orderBy('id', 'desc')->get();
		}

		/**
		 * Store a newly created resource in storage.
		 */
		public function store(Request $request)
		{
				$item = Guia::create($request->all());
				return response()->json($item);
		}

		/**
		 * Display the specified resource.
		 */
		public function show(string $id)
		{
				return Guia::find($id);
		}

		/**
		 * Update the specified resource in storage.
		 */
		public function update(Request $request, string $id)
		{
			$item = Guia::findOrFail($id);
			$item->update($request->all());
			return $item;
		}

		/**
		 * Remove the specified resource from storage.
		 */
		public function destroy(string $id)
		{
			$guia = Guia::findOrFail($id);
			$guia->update(['activo' => 0]);
			return response()->json([
				'message' => 'Guía eliminado',
			]);
		}
}
