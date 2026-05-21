<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VentaGuia extends Model
{
    use HasFactory;

    protected $table = 'venta_guias';

    protected $fillable = [
        'venta_item_id',
        'guia_id',
        'fecha',
        'hora',
        'lugar_encuentro',
        'costo',
        'tipo_servicio',
    ];

    protected $casts = [
        'fecha' => 'date',
        'costo' => 'decimal:2',
        'tipo_servicio' => 'string',
    ];

    public function ventaItem()
    {
        return $this->belongsTo(VentaItem::class);
    }

    public function guia()
    {
        return $this->belongsTo(Guia::class);
    }
}
