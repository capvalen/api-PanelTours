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
        'tipo_tour',
        'tour_id',
        'descripcion',
        'fecha_salida',
        'fecha_retorno',
        'cantidad_personas',
        'cantidad_adultos',
        'cantidad_ninos',
        'peruanos_adultos',
        'peruanos_kids',
        'extranjeros_adultos',
        'extranjeros_kids',
        'precio',
        'costo',
        'incluye',
        'no_incluye',
        'punto_partida',
        'punto_llegada',
        'hora_salida',
        'hora_retorno',
        'estado',
        'requisitos',
        'observaciones',
        'activo',
    ];

    protected $casts = [
        'fecha_salida' => 'date',
        'fecha_retorno' => 'date',
        'precio' => 'decimal:2',
        'costo' => 'decimal:2',
        'activo' => 'boolean',
    ];

    public function ventaItem()
    {
        return $this->belongsTo(VentaItem::class);
    }
}
