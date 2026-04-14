<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class VentaRestaurante extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'venta_restaurantes';

    protected $fillable = [
        'venta_item_id',
        'nombre_cliente',
        'estado',
        'comprobante',
        'fecha_confirmacion',
        'motivo_cancelacion',
        'turno',
        'tipo_servicio',
        'espacio',
        'numero_personas',
        'precio',
        'fecha_hora_reserva',
        'pedido_especial',
        'restaurante_id',
    ];

    protected $casts = [
        'fecha_confirmacion' => 'datetime',
        'fecha_hora_reserva' => 'datetime',
        'precio' => 'decimal:2',
    ];

    public function ventaItem()
    {
        return $this->belongsTo(VentaItem::class);
    }

    public function restaurante()
    {
        return $this->belongsTo(Restaurante::class);
    }
}
