<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CajaDetalle extends Model
{
    use HasFactory;

    protected $table = 'caja_detalles';

    protected $fillable = [
        'caja_id',
        'tipo',
        'categoria',
        'monto',
        'concepto',
        'fecha',
        'comprobante_pago',
        'serie',
        'venta_id',
        'observaciones',
				'metodo_pago',
        'proveedor_id',
        'activo',
    ];

    protected $casts = [
        'monto' => 'decimal:2',
        'fecha' => 'datetime',
        'activo' => 'boolean',
    ];

    public function caja()
    {
        return $this->belongsTo(Caja::class);
    }

    public function venta()
    {
        return $this->belongsTo(Venta::class);
    }
}
