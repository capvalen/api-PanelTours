<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CotizacionItem extends Model
{
    use HasFactory;

    protected $table = 'cotizacion_items';

    protected $fillable = [
        'cotizacion_id',
        'tipo',
        'precio',
        'descuento',
        'motivo_descuento',
        'descripcion',
        'activo',
    ];

    protected $casts = [
        'precio' => 'decimal:2',
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
