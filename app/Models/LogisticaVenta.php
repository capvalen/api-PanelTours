<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class LogisticaVenta extends Pivot
{
    protected $table = 'logistica_ventas';

    protected $fillable = [
        'logistica_id',
        'venta_id',
    ];
}
