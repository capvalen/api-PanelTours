<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Cotizacion;
use App\Models\CotizacionItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Venta;
use App\Models\VentaItem;

class CotizacionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $query = Cotizacion::orderBy('id', 'desc')
            ->with('items', 'departamento');

        // Filtro por fecha (formato: YYYY-MM-DD)
        if (request()->has('fecha') && request()->filled('fecha')) {
            $query->whereDate('fecha', request('fecha'));
        }

        // Filtro de búsqueda: nombre/razon_social, dni, ruc, celular (del cliente) o id de cotización
        if (request()->has('search') && request()->filled('search')) {
            $search = request('search');

            // Detectar si es formato COT-00{id}
            if (preg_match('/^COT-00(\d+)$/i', $search, $matches)) {
                $query->where('id', (int) $matches[1]);
            } elseif (is_numeric($search)) {
                // Buscar por ID directamente (con AND para respetar filtro fecha)
                $query->where('id', (int) $search);
            } else {
                // Búsqueda por datos del cliente
                $query->whereHas('cliente', function ($q) use ($search) {
                    $q->where('razon_social', 'like', "%{$search}%")
                      ->orWhere('nombres', 'like', "%{$search}%")
                      ->orWhere('apellidos', 'like', "%{$search}%")
                      ->orWhere('dni', 'like', "%{$search}%")
                      ->orWhere('ruc', 'like', "%{$search}%")
                      ->orWhere('celular', 'like', "%{$search}%");
                });
            }
        }

        // Límite de resultados para no sobrecargar
        $query->limit(request('limit', 50));

        return $query->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $canasta = $request->input('canasta', []);
        $cotizacionData = $request->input('venta', []); // Manteniendo compatibilidad con la estructura que envíe el cliente
        
        if (empty($cotizacionData)) {
            $cotizacionData = $request->input('cotizacion', []);
        }
        if (empty($cotizacionData)) {
            $cotizacionData = $request->all();
        }

        if (array_key_exists('personas', $cotizacionData) && !array_key_exists('cuantas_personas', $cotizacionData)) {
            $cotizacionData['cuantas_personas'] = $cotizacionData['personas'];
        }
        unset($cotizacionData['personas']);

        $cotizacion = Cotizacion::create($cotizacionData);

        foreach ($canasta as $item) {
            $resumen = $item['resumen'] ?? $item;
            $resumen['cotizacion_id'] = $cotizacion->id;
            
            // Si el cliente envía descuento y motivo_descuento en el item
            if (isset($item['descuento'])) {
                $resumen['descuento'] = $item['descuento'];
            }
            if (isset($item['motivo_descuento'])) {
                $resumen['motivo_descuento'] = $item['motivo_descuento'];
            }

            CotizacionItem::create($resumen);
        }

        return response()->json($cotizacion);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return Cotizacion::findOrFail($id)->load('items', 'departamento');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $cotizacion = Cotizacion::findOrFail($id);
        $cotizacionData = $request->input('venta');
        
        if (empty($cotizacionData)) {
            $cotizacionData = $request->input('cotizacion');
        }
        
        $data = is_array($cotizacionData) ? $cotizacionData : $request->all();
        
        if (array_key_exists('personas', $data) && !array_key_exists('cuantas_personas', $data)) {
            $data['cuantas_personas'] = $data['personas'];
        }
        unset($data['personas']);

        DB::transaction(function () use ($request, $cotizacion, $data) {
            $cotizacion->update($data);

            if ($request->has('canasta') && is_array($request->input('canasta'))) {
                $canasta = $request->input('canasta', []);
                $cotizacionItemIds = $cotizacion->items()->withoutGlobalScopes()->pluck('id');

                if ($cotizacionItemIds->isNotEmpty()) {
                    CotizacionItem::withoutGlobalScopes()->whereIn('id', $cotizacionItemIds)->delete();
                }

                foreach ($canasta as $canastaItem) {
                    $resumen = is_array($canastaItem['resumen'] ?? null) ? $canastaItem['resumen'] : $canastaItem;
                    $resumen['cotizacion_id'] = $cotizacion->id;

                    if (isset($canastaItem['descuento'])) {
                        $resumen['descuento'] = $canastaItem['descuento'];
                    }
                    if (isset($canastaItem['motivo_descuento'])) {
                        $resumen['motivo_descuento'] = $canastaItem['motivo_descuento'];
                    }

                    CotizacionItem::create($resumen);
                }
            }
        });

        return $cotizacion->fresh()->load('items', 'departamento');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id, Request $request)
    {
        $cotizacion = Cotizacion::findOrFail($id);

        if ($request->has('anular')) {
            $cotizacion->update(['estado' => 'anulado']);
        } else {
            if (isset($cotizacion->activo)) {
                $cotizacion->update(['activo' => 0]);
            } else {
                $cotizacion->delete();
            }
        }

        return response()->json(["message" => "Cotizacion eliminada"]);
    }

    /**
     * Generar PDF de la cotización.
     */
    public function generarPdf(string $id)
    {       
        $cotizacion = Cotizacion::with('items', 'cliente', 'departamento')
            ->withoutGlobalScope('activo')
            ->findOrFail($id);

        $codigo = 'COT-' . str_pad($cotizacion->id, 3, '0', STR_PAD_LEFT);

        $data = [
            'cotizacion' => $cotizacion,
            'cliente' => $cotizacion->cliente,
            'items' => $cotizacion->items,
            'total' => $cotizacion->items->sum('precio'),
            'codigo' => $codigo,
        ];

        $pdf = Pdf::loadView('pdf.cotizacion', $data);
        $pdf->setPaper('A4', 'portrait');

        return $pdf->stream("{$codigo}.pdf");
    }

    /**
     * Convertir cotización en reserva (venta).
     */
    public function convertirReserva(string $id, Request $request)
    {
        $cotizacion = Cotizacion::withoutGlobalScope('activo')
            ->with('items')
            ->findOrFail($id);

        if ($cotizacion->estado !== 'activo') {
            return response()->json(['message' => 'La cotización no está activa'], 400);
        }

        return DB::transaction(function () use ($cotizacion, $request) {
            // Crear la venta a partir de la cotización
            $venta = Venta::create([
                'cliente_id' => $cotizacion->cliente_id,
                'user_id' => $cotizacion->usuario_id,
                'fecha' => now()->toDateString(),
                'adults' => $cotizacion->adults,
                'kids' => $cotizacion->kids,
                'cuantas_personas' => $cotizacion->cuantas_personas,
                'departamento_id' => $cotizacion->departamento_id,
                'precio_adultos' => $cotizacion->precio_adultos,
                'precio_kids' => $cotizacion->precio_kids,
                'costo' => $cotizacion->costo,
                'descuento' => $cotizacion->descuento,
                'motivo_descuento' => $cotizacion->motivo_descuento,
                'precio' => $cotizacion->precio,
                'adelanto' => $cotizacion->adelanto ?? 0,
                'estado' => 'pendiente',
                'nacionalidad' => $cotizacion->nacionalidad,
            ]);

            // Copiar items de la cotización a la venta
            foreach ($cotizacion->items as $item) {
                VentaItem::create([
                    'venta_id' => $venta->id,
                    'tipo' => $item->tipo,
                    'descripcion' => $item->descripcion,
                    'destino' => $item->destino,
                    'precio_adulto' => $item->precio_adulto,
                    'precio_kids' => $item->precio_kids,
                    'descuento' => $item->descuento,
                    'motivo_descuento' => $item->motivo_descuento,
                    'precio' => $item->precio,
                ]);
            }

            // Marcar cotización como convertida
            $cotizacion->update(['estado' => 'convertido']);

            return response()->json([
                'message' => 'Cotización convertida a reserva exitosamente',
                'venta_id' => $venta->id,
                'venta' => $venta->fresh()->load('items'),
            ]);
        });
    }
}
