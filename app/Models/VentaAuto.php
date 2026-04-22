<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VentaAuto extends Model
{
    use HasFactory;

    protected $table = 'venta_autos';

    protected $fillable = [
        'venta_item_id',
        'vehiculo_id',
        'origen',
        'destino',
        'fecha_inicio',
        'fecha_fin',
        'hora_recogida',
        'hora_devolucion',
        'estado_alquiler',
        'pasajeros',
        'costo',
        'precio',
        'observaciones',
        'activo',
    ];

    protected $casts = [
        'fecha_inicio' => 'date',
        'fecha_fin' => 'date',
        'costo' => 'decimal:2',
        'precio' => 'decimal:2',
        'activo' => 'boolean',
    ];

    public function ventaItem()
    {
        return $this->belongsTo(VentaItem::class);
    }

    public function vehiculo()
    {
        return $this->belongsTo(Vehiculo::class);
    }

    public function pasajeros()
    {
        return $this->hasMany(VentaAutoPasajero::class);
    }
}
