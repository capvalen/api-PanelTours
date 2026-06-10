<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Logistica;
use App\Models\LogisticaVenta;
use App\Models\Venta;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class LogisticaController extends Controller
{
    public function index(Request $request)
    {
        $query = Logistica::with('ventas.cliente', 'ventas.personas', 'guia', 'vehiculo')->orderBy('fecha', 'desc');

        if ($request->filled('fecha')) {
            $query->whereDate('fecha', $request->fecha);
        } elseif ($request->filled('desde')) {
            $query->whereDate('fecha', '>=', $request->desde);
        }

        if ($request->filled('estado')) {
            $query->where('estado', $request->estado);
        }

        return $query->get();
    }

    public function show(int $id)
    {
        return Logistica::with('ventas.cliente', 'ventas.personas', 'usuario', 'guia', 'vehiculo')->findOrFail($id);
    }

    public function update(Request $request, int $id)
    {
        $item = Logistica::findOrFail($id);
        $oldEstado = $item->estado;
        $item->update($request->all());

        if ($oldEstado !== 'finalizado' && $item->estado === 'finalizado') {
            $item->generarComisiones($request->input('monto'));
        }

        return response()->json($item);
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $logistica = Logistica::create($data);

        if ($request->has('venta_id')) {
            LogisticaVenta::create([
                'logistica_id' => $logistica->id,
                'venta_id' => $request->venta_id,
            ]);
        }

        return response()->json($logistica, 201);
    }

    public function vincularVenta(Request $request)
    {
        $request->validate([
            'logistica_id' => 'required|exists:logistica,id',
            'venta_id' => 'required|exists:ventas,id',
        ]);

        LogisticaVenta::create([
            'logistica_id' => $request->logistica_id,
            'venta_id' => $request->venta_id,
        ]);

        return response()->json(['message' => 'Venta vinculada']);
    }

    public function generarManifiestoPdf(string $token)
    {
        $encoded = $token;
        if (!$encoded) {
            return response()->json(['error' => 'Parámetro inválido'], 400);
        }
        $decoded = base64_decode($encoded);
        $json = strrev($decoded);
        $data = json_decode($json, true);
        $id = $data['id'] ?? null;
        if (!$id) {
            return response()->json(['error' => 'ID no encontrado'], 400);
        }
        $logistica = Logistica::with('ventas.cliente', 'ventas.personas', 'guia', 'vehiculo', 'usuario')->findOrFail($id);

        $logoPath = public_path('images/logo.webp');
        $logoBase64 = '';
        if (file_exists($logoPath)) {
            $img = imagecreatefromwebp($logoPath);
            if ($img) {
                imagefilter($img, IMG_FILTER_GRAYSCALE);
                ob_start();
                imagewebp($img);
                $logoBase64 = base64_encode(ob_get_clean());
                imagedestroy($img);
            }
        }

        $data = [
            'logistica' => $logistica,
            'logoBase64' => $logoBase64,
        ];

        $pdf = Pdf::loadView('pdf.manifiesto', $data);
        $pdf->setPaper('a4', 'portrait');

        return $pdf->stream('manifiesto-' . $logistica->id . '.pdf');
    }
}
