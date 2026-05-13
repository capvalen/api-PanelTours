<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Controllers
use App\Http\Controllers\Api\UsuarioController;
use App\Http\Controllers\Api\ClienteController;
use App\Http\Controllers\Api\DepartamentoController;
use App\Http\Controllers\Api\GuiaController;
use App\Http\Controllers\Api\VueloController;
use App\Http\Controllers\Api\ProveedorController;
use App\Http\Controllers\Api\AerolineaController;
use App\Http\Controllers\Api\RecordatorioController;
use App\Http\Controllers\Api\HospedajeController;
use App\Http\Controllers\Api\RestauranteController;
use App\Http\Controllers\Api\VehiculoController;
use App\Http\Controllers\Api\VentaController;
use App\Http\Controllers\Api\CajaController;
use App\Http\Controllers\Api\VentaItemController;
use App\Http\Controllers\Api\CajaDetalleController;
use App\Http\Controllers\Api\VentaVueloController;
use App\Http\Controllers\Api\VentaHospedajeController;
use App\Http\Controllers\Api\VentaAutoController;
use App\Http\Controllers\Api\VentaRestauranteController;
use App\Http\Controllers\Api\VentaTurismoController;
use App\Http\Controllers\Api\VentaGuiaController;
use App\Http\Controllers\Api\VentaVueloPasajeroController;
use App\Http\Controllers\Api\VentaAutoPasajeroController;
use App\Http\Controllers\Api\PagoController;
use App\Http\Controllers\Api\DeudaController;
use App\Http\Controllers\Api\ArchivoController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/login', [UsuarioController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
	Route::apiResource('usuarios', UsuarioController::class);
	// 1. Tablas Independientes Base
	Route::apiResource('clientes', ClienteController::class);
	Route::apiResource('departamentos', DepartamentoController::class)->only(['index']); // Solo listar
	Route::apiResource('guias', GuiaController::class);
	Route::apiResource('vuelos', VueloController::class);
	Route::apiResource('proveedores', ProveedorController::class);
	Route::apiResource('aerolineas', AerolineaController::class);
	Route::apiResource('recordatorios', RecordatorioController::class);
	
	// 2. Tablas de Dependencia Leve
	Route::apiResource('hospedajes', HospedajeController::class);
	Route::apiResource('restaurantes', RestauranteController::class);
	Route::apiResource('vehiculos', VehiculoController::class);
	
	// 3. Tablas Transaccionales Core
	Route::apiResource('ventas', VentaController::class);
	Route::apiResource('cajas', CajaController::class);
	
	// 4. Tablas Detalle e Items
	Route::apiResource('venta_items', VentaItemController::class);
	Route::apiResource('caja_detalles', CajaDetalleController::class);
	
	// 5. Detalles Específicos de Items de Venta
	Route::apiResource('venta_hospedajes', VentaHospedajeController::class);
	Route::apiResource('venta_autos', VentaAutoController::class);
	Route::apiResource('venta_restaurantes', VentaRestauranteController::class);
	Route::apiResource('venta_turismo', VentaTurismoController::class);
	Route::apiResource('venta_guias', VentaGuiaController::class);
	
	// 6. Subdetalles y Pasajeros
	Route::apiResource('venta_vuelos', VentaVueloController::class);
	Route::apiResource('venta_vuelos_pasajeros', VentaVueloPasajeroController::class);
	Route::apiResource('venta_autos_pasajeros', VentaAutoPasajeroController::class);
	
	// 7. Módulo Financiero
	Route::apiResource('ventas.pagos', PagoController::class)->parameters(['ventas' => 'idVenta'])->except(['options']);
	Route::apiResource('deudas', DeudaController::class);
	
	//prueba
	Route::get('/prueba', function(){
		return "hola mundo";
	});

	//Personalizadas
	Route::put('/cajas/aperturar', [CajaController::class, 'aperturar']);
	Route::put('/cajas/cerrar/{id}', [CajaController::class, 'cerrar']);
	Route::post('/archivos', [ArchivoController::class, 'store']);
	Route::post('/clientes/{id}/adjuntar_archivo', [ClienteController::class, 'adjuntarArchivo']);
});
