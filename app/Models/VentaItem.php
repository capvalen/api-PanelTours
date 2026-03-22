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
        'descripcion',
        'activo',
    ];

    protected $casts = [
        'precio' => 'decimal:2',
        'activo' => 'boolean',
    ];

    public function venta()
    {
        return $this->belongsTo(Venta::class);
    }

    public function ventaVuelo()
    {
        return $this->hasOne(VentaVuelo::class);
    }

    public function ventaHospedaje()
    {
        return $this->hasOne(VentaHospedaje::class);
    }

    public function ventaAuto()
    {
        return $this->hasOne(VentaAuto::class);
    }

    public function ventaRestaurante()
    {
        return $this->hasOne(VentaRestaurante::class);
    }

    public function ventaTurismo()
    {
        return $this->hasOne(VentaTurismo::class);
    }

    public function ventaGuia()
    {
        return $this->hasOne(VentaGuia::class);
    }
}
