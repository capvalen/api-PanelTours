<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Configuracion;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class ConfiguracionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $configuraciones = Configuracion::all();
        return response()->json($configuraciones);
    }

    /**
     * Store a newly created or updated resource in storage.
     */
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'clave' => ['required', 'string'],
            'valor' => ['nullable'],
        ]);

        // Siempre crea un registro nuevo (permite varias temporadas con la misma clave).
        $configuracion = Configuracion::create($validated);

        return response()->json($configuracion, 201);
    }

    /**
     * Display the specified resource by ID or key.
     */
    public function show(string $id): JsonResponse
    {
        $configuracion = is_numeric($id)
            ? Configuracion::find($id)
            : Configuracion::where('clave', $id)->first();

        if (!$configuracion) {
            return response()->json(['message' => 'Configuración no encontrada.'], 404);
        }

        return response()->json($configuracion);
    }

    /**
     * Display the specified resource by key.
     */
    public function getByClave(string $clave): JsonResponse
    {
        $configuracion = Configuracion::where('clave', $clave)->first();

        if (!$configuracion) {
            return response()->json(['message' => 'Configuración no encontrada.'], 404);
        }

        return response()->json($configuracion);
    }

    /**
     * Obtener una temporada por ID (acceso público para previsualizaciones).
     */
    public function temporadaPublica(string $id): JsonResponse
    {
        $configuracion = Configuracion::where('clave', 'temporada')->find($id);

        if (!$configuracion || !$configuracion->valor) {
            return response()->json(['message' => 'Temporada no encontrada.'], 404);
        }

        return response()->json($configuracion);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): JsonResponse
    {
        $configuracion = is_numeric($id)
            ? Configuracion::find($id)
            : Configuracion::where('clave', $id)->first();

        if (!$configuracion) {
            return response()->json(['message' => 'Configuración no encontrada.'], 404);
        }

        $validated = $request->validate([
            'clave' => ['sometimes', 'required', 'string'],
            'valor' => ['nullable'],
        ]);

        $configuracion->update($validated);

        return response()->json($configuracion);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): JsonResponse
    {
        $configuracion = is_numeric($id)
            ? Configuracion::find($id)
            : Configuracion::where('clave', $id)->first();

        if (!$configuracion) {
            return response()->json(['message' => 'Configuración no encontrada.'], 404);
        }

        $configuracion->delete();

        return response()->json(['message' => 'Configuración eliminada correctamente.']);
    }
}
