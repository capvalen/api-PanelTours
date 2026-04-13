<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehiculo extends Model
{
    use HasFactory;

    protected $table = 'vehiculos';

    protected $fillable = [
        'tipo_vehiculo',
        'placa',
        'dni_conductor',
        'nombre_conductor',
        'licencia_conductor',
        'edad_conductor',
        'tipo_combustible',
        'incluye_seguro',
        'seguro',
        'incluye_gps',
        'incluye_silla_bebe',
        'acepta_mascotas',
        'archivos',
        'activo',
    ];

    protected $casts = [
        'incluye_seguro' => 'boolean',
        'incluye_gps' => 'boolean',
        'incluye_silla_bebe' => 'boolean',
        'acepta_mascotas' => 'boolean',
        'archivos' => 'array',
        'activo' => 'boolean',
    ];

    public function ventaAutos()
    {
        return $this->hasMany(VentaAuto::class);
    }
    public function getArchivosAttribute($value)
    {
        return $value ? json_decode($value, true) : [];
    }
}
