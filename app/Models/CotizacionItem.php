<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CotizacionItem extends Model
{
    use HasFactory;

    protected $table = 'cotizacion_items';

    protected $fillable = [
        'cotizacion_id', 'tipo', 'precio', 'precio_adulto', 'precio_kids',
        'descuento', 'motivo_descuento', 'descripcion', 'destino', 'activo', 'id_tour',
    ];

    protected $casts = [
        'precio' => 'decimal:2',
        'precio_adulto' => 'decimal:2',
        'precio_kids' => 'decimal:2',
        'descuento' => 'decimal:2',
        'activo' => 'boolean',
    ];

    public function cotizacion()
    {
        return $this->belongsTo(Cotizacion::class);
    }

    protected static function boot()
    {
        parent::boot();
        
        static::addGlobalScope('activo', function ($query) {
            $query->where('activo', 1);
        });
    }
}
