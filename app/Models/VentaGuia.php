<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VentaGuia extends Model
{
    use HasFactory;

    protected $table = 'venta_guias';

    protected $fillable = [
        'venta_item_id',
        'guia_id',
        'ruta',
        'fecha',
        'hora',
        'lugar_encuentro',
        'costo',
        'duracion_horas',
        'tipo_servicio',
        'cantidad_personas',
        'activo',
    ];

    protected $casts = [
        'fecha' => 'date',
        'costo' => 'decimal:2',
        'activo' => 'boolean',
    ];

    public function ventaItem()
    {
        return $this->belongsTo(VentaItem::class);
    }

    public function guia()
    {
        return $this->belongsTo(Guia::class);
    }
}
