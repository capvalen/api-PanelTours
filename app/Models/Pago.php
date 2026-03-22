<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pago extends Model
{
    use HasFactory;

    protected $table = 'pagos';

    protected $fillable = [
        'venta_id',
        'fecha',
        'es_compromiso',
        'fecha_compromiso',
        'monto_abonado',
        'saldo_pendiente',
        'metodo_pago',
        'estado_pago',
        'codigo_referencia',
        'activo',
    ];

    protected $casts = [
        'fecha' => 'datetime',
        'es_compromiso' => 'boolean',
        'fecha_compromiso' => 'date',
        'monto_abonado' => 'decimal:2',
        'saldo_pendiente' => 'decimal:2',
        'activo' => 'boolean',
    ];

    public function venta()
    {
        return $this->belongsTo(Venta::class);
    }
}
