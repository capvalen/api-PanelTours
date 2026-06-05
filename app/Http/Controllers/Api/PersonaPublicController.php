<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Persona;
use App\Models\Venta;
use App\Models\VentaItem;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class PersonaPublicController extends Controller
{
    public function showByVenta(int $venta_id): JsonResponse
    {
        $venta = Venta::query()
            ->with(['personas' => function ($query) {
                $query->where('activo', 1)
                    ->orderByDesc('es_titular')
                    ->orderBy('id');
            }])
            ->find($venta_id);

        if (!$venta) {
            return response()->json([
                'message' => 'Venta activa no encontrada.',
            ], 404);
        }

        $personas = $venta->getRelation('personas')->map(function ($persona) {
            return [
                'id' => $persona->id,
                'es_titular' => (bool) $persona->es_titular,
                'dni' => $persona->dni,
                'nombre' => $persona->nombre,
                'fecha_nacimiento' => optional($persona->fecha_nacimiento)->format('Y-m-d'),
                'parentesco' => $persona->parentesco,
                'enfermedades' => $persona->enfermedades,
                'detalle_enfermedades' => $persona->detalle_enfermedades,
                'pasaporte' => $persona->pasaporte,
                'fecha_caducidad_pasaporte' => optional($persona->fecha_caducidad_pasaporte)->format('Y-m-d'),
                'pais_emision' => $persona->pais_emision,
                'vacunas' => $persona->vacunas,
                'detalle_vacunas' => $persona->detalle_vacunas,
                'alergia' => $persona->alergia,
                'detalle_alergia' => $persona->detalle_alergia,
                'pedido_especial' => $persona->pedido_especial,
                'celular' => $persona->celular,
                'contacto_emergencia' => $persona->contacto_emergencia,
                'celular_emergencia' => $persona->celular_emergencia,
                'observaciones' => $persona->observaciones,
            ];
        })->values();

        $titular = $personas->firstWhere('es_titular', true) ?? $personas->first();
        $ventaItemPrioritario = VentaItem::query()
            ->where('venta_id', $venta->id)
            ->orderByRaw("CASE WHEN tipo = 'vuelo' THEN 0 ELSE 1 END")
            ->orderBy('id')
            ->first();

        return response()->json([
            'venta' => [
                'venta_id' => $venta->id,
                'tipo' => $ventaItemPrioritario?->tipo,
                'descripcion' => $ventaItemPrioritario?->descripcion,
                'nro_clientes' => $ventaItemPrioritario?->nro_clientes,
            ],
            'venta_id' => $venta->id,
            'total' => $venta->cuantas_personas,// $personas->count(),
            'titular' => $titular,
            'personas' => $personas,
        ]);
    }

    public function storeByVenta(Request $request, int $venta_id): JsonResponse
    {
        $venta = Venta::query()->find($venta_id);

        if (!$venta) {
            return response()->json([
                'message' => 'Venta activa no encontrada.',
            ], 404);
        }

        $personasFiltradas = collect($request->input('personas', []))
            ->filter(function ($persona) {
                if (!is_array($persona)) {
                    return false;
                }

                return filled($persona['nombre'] ?? null) || filled($persona['dni'] ?? null);
            })
            ->values()
            ->all();

        $request->merge([
            'personas' => $personasFiltradas,
        ]);

        $validated = $request->validate([
            'personas' => ['required', 'array', 'min:1'],
            'personas.*.es_titular' => ['nullable', 'boolean'],
            'personas.*.dni' => ['nullable', 'string', 'max:20'],
            'personas.*.nombre' => ['required', 'string', 'max:150'],
            'personas.*.fecha_nacimiento' => ['nullable', 'date'],
            'personas.*.parentesco' => ['nullable', 'string', 'max:50'],
            'personas.*.enfermedades' => ['nullable', 'in:si,no'],
            'personas.*.detalle_enfermedades' => ['nullable', 'string'],
            'personas.*.observaciones' => ['nullable', 'string'],
            'personas.*.pasaporte' => ['nullable', 'string', 'max:50'],
            'personas.*.fecha_caducidad_pasaporte' => ['nullable', 'date'],
            'personas.*.pais_emision' => ['nullable', 'string', 'max:100'],
            'personas.*.vacunas' => ['nullable', 'in:si,no'],
            'personas.*.detalle_vacunas' => ['nullable', 'string'],
            'personas.*.alergia' => ['nullable', 'in:si,no'],
            'personas.*.detalle_alergia' => ['nullable', 'string'],
            'personas.*.pedido_especial' => ['nullable', 'string'],
            'personas.*.celular' => ['nullable', 'string', 'max:20'],
            'personas.*.contacto_emergencia' => ['nullable', 'string', 'max:150'],
            'personas.*.celular_emergencia' => ['nullable', 'string', 'max:20'],
            'autorizaciones' => ['required', 'array'],
            'autorizaciones.uso_imagen' => ['required', 'boolean'],
            'autorizaciones.politica_privacidad' => ['required', 'boolean'],
            'autorizaciones.terminos_condiciones' => ['required', 'boolean'],
            'autorizaciones.politica_cancelacion' => ['required', 'boolean'],
        ]);

        DB::transaction(function () use ($venta, $validated) {
            Persona::query()->where('venta_id', $venta->id)->delete();

            foreach ($validated['personas'] as $persona) {
                Persona::create([
                    'venta_id' => $venta->id,
                    'es_titular' => (bool) ($persona['es_titular'] ?? false),
                    'dni' => $persona['dni'] ?? null,
                    'nombre' => $persona['nombre'],
                    'fecha_nacimiento' => $persona['fecha_nacimiento'] ?? null,
                    'parentesco' => $persona['parentesco'] ?? 'acompañante',
                    'enfermedades' => $persona['enfermedades'] ?? 'no',
                    'detalle_enfermedades' => $persona['detalle_enfermedades'] ?? null,
                    'observaciones' => $persona['observaciones'] ?? null,
                    'pasaporte' => $persona['pasaporte'] ?? null,
                    'fecha_caducidad_pasaporte' => $persona['fecha_caducidad_pasaporte'] ?? null,
                    'pais_emision' => $persona['pais_emision'] ?? null,
                    'vacunas' => $persona['vacunas'] ?? 'no',
                    'detalle_vacunas' => $persona['detalle_vacunas'] ?? null,
                    'alergia' => $persona['alergia'] ?? 'no',
                    'detalle_alergia' => $persona['detalle_alergia'] ?? null,
                    'pedido_especial' => $persona['pedido_especial'] ?? null,
                    'celular' => $persona['celular'] ?? null,
                    'contacto_emergencia' => $persona['contacto_emergencia'] ?? null,
                    'celular_emergencia' => $persona['celular_emergencia'] ?? null,
                    'activo' => 1,
                ]);
            }

            $venta->autorizaciones = [
                'uso_imagen' => (bool) $validated['autorizaciones']['uso_imagen'],
                'politica_privacidad' => (bool) $validated['autorizaciones']['politica_privacidad'],
                'terminos_condiciones' => (bool) $validated['autorizaciones']['terminos_condiciones'],
                'politica_cancelacion' => (bool) $validated['autorizaciones']['politica_cancelacion'],
            ];
            $venta->save();
        });

        return response()->json([
            'message' => 'Registro guardado correctamente.',
            'venta_id' => $venta->id,
        ]);
    }
}
