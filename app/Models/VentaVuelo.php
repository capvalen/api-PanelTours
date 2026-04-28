<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VentaVuelo extends Model
{
    use HasFactory;

    protected $table = 'venta_vuelos';

    protected $fillable = [
        'venta_item_id',
        'origen',
        'destino',
        'pasajeros',
        'que_equipaje',
        'lleva_equipaje',
        'kilos',
        'precio_ticket',
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
        'asientos_asignados',
        'clase_vuelo',
        'escala',
        'observaciones',
        'activo',
    ];

    protected $casts = [
        'precio_ticket' => 'decimal:2',
        'precio_soles' => 'decimal:2',
        'precio_dolares' => 'decimal:2',
        'costo_soles' => 'decimal:2',
        'costo_dolares' => 'decimal:2',
        'fecha_salida' => 'datetime',
        'fecha_llegada' => 'datetime',
        'escala' => 'boolean',
        'activo' => 'boolean',
    ];

    public function ventaItem()
    {
        return $this->belongsTo(VentaItem::class);
    }

    public function pasajerosObj()
    {
        return $this->hasMany(VentaVueloPasajero::class, 'venta_vuelo_id');
    }
}
