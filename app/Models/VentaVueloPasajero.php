<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VentaVueloPasajero extends Model
{
    use HasFactory;

    protected $table = 'venta_vuelos_pasajeros';

    protected $fillable = [
        'venta_vuelo_tramo_id',
        'numero_asiento',
        'dni',
        'nombre',
        'fecha_nacimiento',
        'numero_pasaporte',
        'fecha_vencimiento_pasaporte',
        'pais_emision_pasaporte',
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
        'fecha_nacimiento' => 'date',
        'fecha_vencimiento_pasaporte' => 'date',
        'fecha_vacunacion_fiebre_amarilla' => 'date',
        'certificado_valido_hasta' => 'date',
        'check_in_realizado' => 'boolean',
        'fecha_check_in' => 'datetime',
        'activo' => 'boolean',
    ];

    public function tramo()
    {
        return $this->belongsTo(VentaVueloTramo::class, 'venta_vuelo_tramo_id');
    }
}
