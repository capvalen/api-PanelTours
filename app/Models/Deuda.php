<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deuda extends Model
{
    use HasFactory;

    protected $table = 'deudas';

    protected $fillable = [
			'proveedor_id',
        'fecha_pago',
        'monto',
        'informacion',
        'contacto_pagar',
        'comprobante',
        'medio_pago',
        'estado_pago',
        'codigo_referencia',
        'activo',
    ];

    protected $casts = [
        'fecha_pago' => 'date',
        'monto' => 'decimal:2',
        'activo' => 'boolean',
    ];
}
