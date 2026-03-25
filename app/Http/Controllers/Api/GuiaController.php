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
		public function index()
		{
				return Guia::orderBy('id', 'desc')->get();
		}

		/**
		 * Store a newly created resource in storage.
		 */
		public function store(Request $request)
		{
				$guia = Guia::create($request->all());
				return response()->json([
						'message' => 'Guía creado correctamente',
						'data' => $guia
				]);
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
			$guia = Guia::findOrFail($id);
			$guia->update($request->all());
			return response()->json([
				'message' => 'Guía actualizada correctamente',
				'data' => $guia
			]);
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
