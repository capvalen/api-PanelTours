<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Cliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

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
					$q->where('dni', 'like', $buscar.'%')
						->orWhere('ruc', 'like', $buscar.'%')
						->orWhere(DB::raw("CONCAT(apellidos, ' ', nombres)"), 'like', '%'. $buscar . '%')
						->orWhere('apellidos', 'like', '%'.$buscar.'%')
						->orWhere('nombres', 'like', '%'.$buscar.'%')
						->orWhere('celular', 'like', $buscar.'%')
						->orWhere('telefono', 'like', $buscar.'%')
						->orWhere('razon_social', 'like', '%'.$buscar.'%');
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
				return response()->json($item);
		}

		/**
		 * Consulta un DNI en el servicio externo de RENIEC.
		 * Devuelve null cuando el DNI no existe o el servicio falla.
		 */
		private function consultarReniec(string $dni): ?array
		{
			try {
				$url = rtrim(config('services.reniec.url'), '/');
				$token = config('services.reniec.token');

				$resp = Http::timeout(10)->get("{$url}/{$dni}/{$token}");

				if (! $resp->successful()) {
					return null;
				}

				$data = $resp->json();

				if (empty($data) || ! empty($data['error']) || empty($data['dni'])) {
					return null;
				}

				return [
					'dni'       => $data['dni'],
					'nombres'   => $data['nombre'] ?? '',
					'apellidos' => $data['apellido'] ?? '',
				];
			} catch (\Throwable $e) {
				return null;
			}
		}

		/**
		 * Busca un DNI en RENIEC sin crear el cliente.
		 * Devuelve además el id del cliente si ya estuviera registrado.
		 */
		public function buscarReniec(string $dni)
		{
			$dni = preg_replace('/\D/', '', $dni);

			if (strlen($dni) !== 8) {
				return response()->json(['error' => 'El DNI debe tener 8 dígitos'], 422);
			}

			$persona = $this->consultarReniec($dni);

			if (! $persona) {
				return response()->json(['error' => 'DNI no encontrado'], 404);
			}

			$existente = Cliente::where('dni', $dni)->first();

			return response()->json([
				...$persona,
				'cliente_id' => $existente?->id,
			]);
		}

		/**
		 * Crea un cliente a partir de un DNI consultado en RENIEC.
		 * Si el cliente ya existe, lo devuelve sin duplicarlo.
		 */
		public function storeDesdeReniec(Request $request)
		{
				$request->validate([
						'dni' => 'required|digits:8',
				]);

				$dni = $request->dni;

				// Si ya existe un cliente con ese DNI, se devuelve directamente
				$existente = Cliente::where('dni', $dni)->first();
				if ($existente) {
						return response()->json($existente);
				}

				$persona = $this->consultarReniec($dni);

				if (! $persona) {
						return response()->json(['error' => 'DNI no encontrado'], 404);
				}

				$cliente = Cliente::create([
						'dni'          => $persona['dni'],
						'nombres'      => $persona['nombres'],
						'apellidos'    => $persona['apellidos'],
						'nacionalidad' => 'peruano',
						'activo'       => true,
				]);

				return response()->json($cliente, 201);
		}

		/**
		 * Display the specified resource.
		 */
		public function show(string $id)
		{
				return Cliente::with([
					'ventas' => function ($q) {
						$q->with('items')->orderBy('id', 'desc');
					}
				])->findOrFail($id);
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
