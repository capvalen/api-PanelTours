<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ArchivoController extends Controller
{
	public function store(Request $request)
	{
		$request->validate([
				'archivo' => 'required|file|max:10240', // 10MB máx
		]);
		$extension = $request->file('archivo')->getClientOriginalExtension();
    $nombre = uniqid() . '.' . $extension; //único id

		//$ruta = $request->file('archivo')->storeAs('adjuntos', $nombre, 'public');
		$ruta = $request->file('archivo')->move(public_path('adjuntos'), $nombre);

		return response()->json([
				'mensaje' => 'Archivo subido',
				'link' => $nombre,
		]);
	}
}
