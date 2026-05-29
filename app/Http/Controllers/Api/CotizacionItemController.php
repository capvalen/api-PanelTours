<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\CotizacionItem;
use Illuminate\Http\Request;

class CotizacionItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return CotizacionItem::orderBy('id', 'desc')->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $item = CotizacionItem::create($request->all());
        return response()->json($item);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return CotizacionItem::find($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $item = CotizacionItem::findOrFail($id);
        $item->update($request->all());
        return $item;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $item = CotizacionItem::findOrFail($id);
        if (isset($item->activo)) {
            $item->update(['activo' => 0]);
        } else {
            $item->delete();
        }
        return response()->json(["message" => "CotizacionItem eliminado"]);
    }
}
