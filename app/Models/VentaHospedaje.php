<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VentaHospedaje extends Model
{
    use HasFactory;

    protected $table = 'venta_hospedajes';

    protected $fillable = [
        'venta_item_id',
        'hospedaje_id',
        'tipo_habitacion',
        'numero_habitacion',
        'fecha_ingreso',
        'fecha_salida',
        'hora_checkin',
        'hora_checkout',
        'cantidad_noches',
        'cantidad_adultos',
        'cantidad_ninos',
        'nombres_huespedes',
        'precio_por_noche',
        'subtotal',
        'impuestos',
        'cargo_servicio',
        'total',
        'anticipo',
        'saldo_pendiente',
        'estado_pago',
        'metodo_pago',
        'estado',
        'motivo_cancelacion',
        'tipo_cama',
        'requiere_cuna',
        'habitacion_fumador',
        'preferencias_especiales',
        'nombre_titular',
        'documento_titular',
        'email_contacto',
        'telefono_contacto',
        'activo',
    ];

    protected $casts = [
        'fecha_ingreso' => 'date',
        'fecha_salida' => 'date',
        'precio_por_noche' => 'decimal:2',
        'subtotal' => 'decimal:2',
        'impuestos' => 'decimal:2',
        'cargo_servicio' => 'decimal:2',
        'total' => 'decimal:2',
        'anticipo' => 'decimal:2',
        'saldo_pendiente' => 'decimal:2',
        'requiere_cuna' => 'boolean',
        'habitacion_fumador' => 'boolean',
        'activo' => 'boolean',
    ];

    public function ventaItem()
    {
        return $this->belongsTo(VentaItem::class);
    }

    public function hospedaje()
    {
        return $this->belongsTo(Hospedaje::class);
    }
}
