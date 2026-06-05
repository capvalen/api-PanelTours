<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Persona;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class PersonaController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $query = Persona::query()->orderBy('id','desc');

        if ($request->filled('venta_id')) {
            $query->where('venta_id', $request->venta_id);
        }

        return response()->json($query->get());
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'venta_id'              => ['required', 'exists:ventas,id'],
            'es_titular'            => ['nullable', 'boolean'],
            'dni'                   => ['nullable', 'string', 'max:20'],
            'nombre'                => ['required', 'string', 'max:150'],
            'fecha_nacimiento'      => ['nullable', 'date'],
            'parentesco'            => ['nullable', 'string', 'max:50'],
            'enfermedades'          => ['nullable', 'in:si,no'],
            'detalle_enfermedades'  => ['nullable', 'string'],
            'pasaporte'             => ['nullable', 'string', 'max:50'],
            'fecha_caducidad_pasaporte' => ['nullable', 'date'],
            'pais_emision'          => ['nullable', 'string', 'max:100'],
            'vacunas'               => ['nullable', 'in:si,no'],
            'detalle_vacunas'       => ['nullable', 'string'],
            'alergia'               => ['nullable', 'in:si,no'],
            'detalle_alergia'       => ['nullable', 'string'],
            'pedido_especial'       => ['nullable', 'string'],
            'celular'               => ['nullable', 'string', 'max:20'],
            'contacto_emergencia'   => ['nullable', 'string', 'max:150'],
            'celular_emergencia'    => ['nullable', 'string', 'max:20'],
            'observaciones'         => ['nullable', 'string'],
        ]);

        $persona = Persona::create([
            'venta_id'                  => $validated['venta_id'],
            'es_titular'                => (bool) ($validated['es_titular'] ?? false),
            'dni'                       => $validated['dni'] ?? null,
            'nombre'                    => $validated['nombre'],
            'fecha_nacimiento'          => $validated['fecha_nacimiento'] ?? null,
            'parentesco'                => $validated['parentesco'] ?? 'acompañante',
            'enfermedades'              => $validated['enfermedades'] ?? 'no',
            'detalle_enfermedades'      => $validated['detalle_enfermedades'] ?? null,
            'pasaporte'                 => $validated['pasaporte'] ?? null,
            'fecha_caducidad_pasaporte' => $validated['fecha_caducidad_pasaporte'] ?? null,
            'pais_emision'              => $validated['pais_emision'] ?? null,
            'vacunas'                   => $validated['vacunas'] ?? 'no',
            'detalle_vacunas'           => $validated['detalle_vacunas'] ?? null,
            'alergia'                   => $validated['alergia'] ?? 'no',
            'detalle_alergia'           => $validated['detalle_alergia'] ?? null,
            'pedido_especial'           => $validated['pedido_especial'] ?? null,
            'celular'                   => $validated['celular'] ?? null,
            'contacto_emergencia'       => $validated['contacto_emergencia'] ?? null,
            'celular_emergencia'        => $validated['celular_emergencia'] ?? null,
            'observaciones'             => $validated['observaciones'] ?? null,
            'activo'                    => 1,
        ]);

        return response()->json($persona, 201);
    }

    public function show(int $id): JsonResponse
    {
        return response()->json(Persona::findOrFail($id));
    }

    public function update(Request $request, int $id): JsonResponse
    {
        $persona = Persona::findOrFail($id);

        $validated = $request->validate([
            'es_titular'            => ['nullable', 'boolean'],
            'dni'                   => ['nullable', 'string', 'max:20'],
            'nombre'                => ['sometimes', 'required', 'string', 'max:150'],
            'fecha_nacimiento'      => ['nullable', 'date'],
            'parentesco'            => ['nullable', 'string', 'max:50'],
            'enfermedades'          => ['nullable', 'in:si,no'],
            'detalle_enfermedades'  => ['nullable', 'string'],
            'pasaporte'             => ['nullable', 'string', 'max:50'],
            'fecha_caducidad_pasaporte' => ['nullable', 'date'],
            'pais_emision'          => ['nullable', 'string', 'max:100'],
            'vacunas'               => ['nullable', 'in:si,no'],
            'detalle_vacunas'       => ['nullable', 'string'],
            'alergia'               => ['nullable', 'in:si,no'],
            'detalle_alergia'       => ['nullable', 'string'],
            'pedido_especial'       => ['nullable', 'string'],
            'celular'               => ['nullable', 'string', 'max:20'],
            'contacto_emergencia'   => ['nullable', 'string', 'max:150'],
            'celular_emergencia'    => ['nullable', 'string', 'max:20'],
            'observaciones'         => ['nullable', 'string'],
        ]);

        $persona->update($validated);

        return response()->json($persona);
    }

    public function destroy(int $id): JsonResponse
    {
        $persona = Persona::findOrFail($id);
        $persona->delete();

        return response()->json(['message' => 'Persona eliminada']);
    }
}
