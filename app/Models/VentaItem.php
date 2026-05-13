<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VentaItem extends Model
{
    use HasFactory;

    protected $table = 'venta_items';

    protected $fillable = [
        'venta_id',
        'tipo',
        'precio',
        'nro_clientes',
        'descripcion',
        'activo',
    ];

    protected $casts = [
        'precio' => 'decimal:2',
        'activo' => 'boolean',
    ];

    protected $appends = ['detalle'];

    protected $with = [
        'ventaVuelo',
        'ventaHospedaje',
        'ventaAuto',
        'ventaRestaurante',
        'ventaTurismo',
        'ventaGuia'
    ];

    protected $hidden = [
        'ventaVuelo',
        'ventaHospedaje',
        'ventaAuto',
        'ventaRestaurante',
        'ventaTurismo',
        'ventaGuia'
    ];

    public function getDetalleAttribute()
    {
        return match ($this->tipo) {
            'vuelo' => $this->ventaVuelo,
            'hospedaje' => $this->ventaHospedaje,
            'transporte' => $this->ventaAuto,
            'restaurante' => $this->ventaRestaurante,
            'tour' => $this->ventaTurismo,
            'guia' => $this->ventaGuia,
            default => null,
        };
    }

    public function venta()
    {
        return $this->belongsTo(Venta::class);
    }

    public function ventaVuelo()
    {
        return $this->hasOne(VentaVuelo::class)->with('pasajerosObj');
    }

    public function ventaHospedaje()
    {
        return $this->hasOne(VentaHospedaje::class)->with('hospedaje');
    }

    public function ventaAuto()
    {
        return $this->hasOne(VentaAuto::class)->with('vehiculo');
    }

    public function ventaRestaurante()
    {
        return $this->hasOne(VentaRestaurante::class)->with('restaurante');
    }

    public function ventaTurismo()
    {
        return $this->hasOne(VentaTurismo::class);
    }

    public function ventaGuia()
    {
        return $this->hasOne(VentaGuia::class)->with('guia');
    }

    // Sobrescribe la consulta base
    protected static function boot()
    {
        parent::boot();
        
        static::addGlobalScope('activo', function ($query) {
            $query->where('activo', 1);
        });
    }
}
