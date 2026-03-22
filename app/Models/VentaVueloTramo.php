<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VentaVueloTramo extends Model
{
    use HasFactory;

    protected $table = 'venta_vuelos_tramos';

    protected $fillable = [
        'venta_vuelo_id',
        'origen',
        'destino',
        'fecha',
        'pasajeros',
        'equipaje',
        'precio_soles',
        'precio_dolares',
        'costo_soles',
        'costo_dolares',
        'codigo_vuelo',
        'aerolinea',
        'numero_vuelo',
        'aeronave',
        'fecha_salida',
        'fecha_llegada',
        'hora_salida',
        'horario_llegada',
        'duracion_minutos',
        'terminal_salida',
        'puerta_embarque',
        'terminal_llegada',
        'estado_tramo',
        'localizador',
        'billete_electronico',
        'asientos_asignados',
        'clase_vuelo',
        'escala',
        'numero_escala',
        'observaciones',
        'activo',
    ];

    protected $casts = [
        'fecha' => 'date',
        'precio_soles' => 'decimal:2',
        'precio_dolares' => 'decimal:2',
        'costo_soles' => 'decimal:2',
        'costo_dolares' => 'decimal:2',
        'fecha_salida' => 'datetime',
        'fecha_llegada' => 'datetime',
        'escala' => 'boolean',
        'activo' => 'boolean',
    ];

    public function ventaVuelo()
    {
        return $this->belongsTo(VentaVuelo::class);
    }

    public function pasajerosObj()
    {
        return $this->hasMany(VentaVueloPasajero::class, 'venta_vuelo_tramo_id');
    }
}
