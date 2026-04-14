<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    use HasFactory;

    protected $table = 'ventas';

    protected $fillable = [
        'cliente_id',
        'fecha',
        'tipo',
        'estado_pago',
        'precio',
        'activo',
    ];

    protected $casts = [
        'precio' => 'decimal:2',
        'fecha' => 'datetime',
        'activo' => 'boolean',
    ];

    protected $with = ['cliente'];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class)->select(['id', 'ruc', 'razon_social', 'dni', 'nombres', 'apellidos']);
    }

    public function items()
    {
        return $this->hasMany(VentaItem::class);
    }

    public function pagos()
    {
        return $this->hasMany(Pago::class);
    }

    public function cajaDetalles()
    {
        return $this->hasMany(CajaDetalle::class);
    }
}
