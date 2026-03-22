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
        'tipo_viaje',
        'activo',
    ];

    protected $casts = [
        'activo' => 'boolean',
    ];

    public function ventaItem()
    {
        return $this->belongsTo(VentaItem::class);
    }

    public function tramos()
    {
        return $this->hasMany(VentaVueloTramo::class);
    }
}
