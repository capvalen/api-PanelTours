<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VentaTurismo extends Model
{
    use HasFactory;

    protected $table = 'venta_turismo';

    protected $fillable = [
        'venta_item_id',
        'nombre_tour',
        'tipo',
        'descripcion',
        'fecha_salida',
        'fecha_retorno',
        'duracion_dias',
        'duracion_noches',
        'cantidad_personas',
        'precio',
        'costo',
        'incluye',
        'no_incluye',
        'punto_partida',
        'punto_llegada',
        'hora_salida',
        'hora_retorno',
        'estado',
        'estado_pago',
        'anticipo',
        'debe',
        'requisitos',
        'observaciones',
        'activo',
    ];

    protected $casts = [
        'fecha_salida' => 'date',
        'fecha_retorno' => 'date',
        'precio' => 'decimal:2',
        'costo' => 'decimal:2',
        'anticipo' => 'decimal:2',
        'debe' => 'decimal:2',
        'activo' => 'boolean',
    ];

    public function ventaItem()
    {
        return $this->belongsTo(VentaItem::class);
    }
}
