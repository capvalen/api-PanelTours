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
use App\Http\Controllers\Api\CotizacionController;
use App\Http\Controllers\Api\CotizacionItemController;
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
use App\Http\Controllers\Api\PersonaController;
use App\Http\Controllers\Api\PersonaPublicController;
use App\Http\Controllers\Api\LogisticaController;
use App\Http\Controllers\Api\ComisionController;
use App\Http\Controllers\Api\ComisionPagoController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/login', [UsuarioController::class, 'login']);

// ─────────────────────────────────────────────
// Grupo autenticado con restricciones por perfil
// ─────────────────────────────────────────────
Route::middleware('auth:sanctum')->group(function () {

	// Todos los autenticados pueden cambiar su propia contraseña
	Route::put('/cambiar-password', [UsuarioController::class, 'cambiarPassword']);

	// Solo administrador
	Route::middleware('check_perfil:administrador')->group(function () {
		Route::apiResource('usuarios', UsuarioController::class);
		Route::apiResource('departamentos', DepartamentoController::class)->only(['index']);
		Route::apiResource('vuelos', VueloController::class);
		Route::apiResource('aerolineas', AerolineaController::class);
		Route::apiResource('recordatorios', RecordatorioController::class);
		Route::apiResource('hospedajes', HospedajeController::class);
		Route::apiResource('restaurantes', RestauranteController::class);
		Route::apiResource('personas', PersonaController::class)->except(['options']);
		Route::apiResource('comisiones', ComisionController::class);
		Route::apiResource('comision-pagos', ComisionPagoController::class);
	});

	// Counter + Admin: cotizaciones, ventas, clientes
	Route::middleware('check_perfil:administrador,counter')->group(function () {
		Route::apiResource('clientes', ClienteController::class);
		Route::post('/clientes/{id}/adjuntar_archivo', [ClienteController::class, 'adjuntarArchivo']);

		Route::apiResource('cotizacion', CotizacionController::class);
		Route::apiResource('cotizacion_items', CotizacionItemController::class);
		Route::post('/cotizacion/{id}/convertir-reserva', [CotizacionController::class, 'convertirReserva']);

		Route::apiResource('ventas', VentaController::class);
		Route::apiResource('venta_items', VentaItemController::class);
		Route::apiResource('venta_hospedajes', VentaHospedajeController::class);
		Route::apiResource('venta_autos', VentaAutoController::class);
		Route::apiResource('venta_restaurantes', VentaRestauranteController::class);
		Route::apiResource('venta_turismo', VentaTurismoController::class);
		Route::apiResource('venta_guias', VentaGuiaController::class);
		Route::apiResource('venta_vuelos', VentaVueloController::class);
		Route::apiResource('venta_vuelos_pasajeros', VentaVueloPasajeroController::class);
		Route::apiResource('venta_autos_pasajeros', VentaAutoPasajeroController::class);
	});

	// Logística + Admin: guías, vehículos, proveedores, logística
	Route::middleware('check_perfil:administrador,logística')->group(function () {
		Route::apiResource('guias', GuiaController::class);
		Route::apiResource('vehiculos', VehiculoController::class);
		Route::apiResource('proveedores', ProveedorController::class);

		Route::get('/logistica', [LogisticaController::class, 'index']);
		Route::get('/logistica/{id}', [LogisticaController::class, 'show']);
		Route::post('/logistica', [LogisticaController::class, 'store']);
		Route::put('/logistica/{id}', [LogisticaController::class, 'update']);
		Route::post('/logistica/vincular-venta', [LogisticaController::class, 'vincularVenta']);
	});

	// Caja + Admin: caja, pagos
	Route::middleware('check_perfil:administrador,caja')->group(function () {
		Route::apiResource('cajas', CajaController::class);
		Route::put('/cajas/aperturar', [CajaController::class, 'aperturar']);
		Route::put('/cajas/cerrar/{id}', [CajaController::class, 'cerrar']);
		Route::apiResource('caja_detalles', CajaDetalleController::class);
		Route::apiResource('ventas.pagos', PagoController::class)->parameters(['ventas' => 'idVenta'])->except(['options']);
		Route::post('/archivos', [ArchivoController::class, 'store']);
	});

	Route::get('/saludo_token', function(){ return "hola token"; });

});

//sin loguearse:
Route::get('/reporte/personas/{venta_id}', [PersonaPublicController::class, 'showByVenta']);
Route::post('/reporte/personas/{venta_id}', [PersonaPublicController::class, 'storeByVenta']);

// Cotización y Venta - PDF
Route::get('/cotizacion/{id}/pdf', [CotizacionController::class, 'generarPdf']);
Route::get('/ticket-pdf/{token}', [PagoController::class, 'generarTicketPdf']);

// Público - manifiesto PDF con ID cifrado
Route::get('/manifiesto-pdf/{token}', [LogisticaController::class, 'generarManifiestoPdf']);

//saludo público
Route::get('/saludo', function(){ return "hola token"; });