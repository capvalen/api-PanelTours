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
        'celular',
        'licencia_conductor',
        'edad_conductor',
        'tipo_combustible',
        'incluye_seguro',
        'seguro',
        'banco',
        'numero_cuenta',
        'aplicativo',
        'propietario_aplicativo',
        'incluye_gps',
        'incluye_silla_bebe',
        'acepta_mascotas',
        'departamento_id',
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

    protected $with = ['departamento'];

    public function departamento()
    {
        return $this->belongsTo(Departamento::class);
    }

    public function ventaAutos()
    {
        return $this->hasMany(VentaAuto::class);
    }
    public function getArchivosAttribute($value)
    {
        return $value ? json_decode($value, true) : [];
    }
}
