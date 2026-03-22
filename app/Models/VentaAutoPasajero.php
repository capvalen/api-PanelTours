<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VentaAutoPasajero extends Model
{
    use HasFactory;

    protected $table = 'venta_autos_pasajeros';

    protected $fillable = [
        'venta_auto_id',
        'numero_asiento',
        'dni',
        'nombre',
        'certificado_fiebre_amarilla',
        'fecha_vacunacion_fiebre_amarilla',
        'certificado_valido_hasta',
        'check_in_realizado',
        'fecha_check_in',
        'usuario_check_in',
        'observaciones_check_in',
        'activo',
    ];

    protected $casts = [
        'fecha_vacunacion_fiebre_amarilla' => 'date',
        'certificado_valido_hasta' => 'date',
        'check_in_realizado' => 'boolean',
        'fecha_check_in' => 'datetime',
        'activo' => 'boolean',
    ];

    public function ventaAuto()
    {
        return $this->belongsTo(VentaAuto::class);
    }
}
