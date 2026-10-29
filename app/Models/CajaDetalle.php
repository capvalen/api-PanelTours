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
        'estado_pago',
        'proveedor_id',
        'activo',
    ];

    protected $casts = [
        'monto' => 'decimal:2',
        'fecha' => 'datetime',
        'activo' => 'boolean',
    ];

    /**
     * Si el frontend envía solo la fecha (YYYY-MM-DD), se completa con la
     * hora actual de America/Lima para que el movimiento no quede a las 00:00.
     */
    public function setFechaAttribute($value)
    {
        if (is_string($value) && preg_match('/^\d{4}-\d{2}-\d{2}$/', trim($value))) {
            $value = trim($value) . ' ' . now()->format('H:i:s');
        } elseif ($value instanceof \DateTimeInterface) {
            $value = $value->format('Y-m-d H:i:s');
        }

        $this->attributes['fecha'] = $value;
    }

    public function caja()
    {
        return $this->belongsTo(Caja::class);
    }

    public function usuario()
    {
        return $this->hasOneThrough(
            Usuario::class,
            Caja::class,
            'id',
            'id',
            'caja_id',
            'usuario_id'
        );
    }

    public function venta()
    {
        return $this->belongsTo(Venta::class);
    }
}
