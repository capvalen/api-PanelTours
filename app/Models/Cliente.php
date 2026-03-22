<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    protected $table = 'clientes';

    protected $fillable = [
        'ruc',
        'razon_social',
        'nombres',
        'apellidos',
        'dni',
        'carnet_extranjeria',
        'fecha_nacimiento',
        'correo',
        'celular',
        'telefono',
        'direccion',
        'nacionalidad',
        'pais_origen',
        'pasaporte',
        'vigencia_pasaporte',
        'visado',
        'valido_visa',
        'vacunacion',
        'vacunacion_fiebre_amarilla',
        'tiene_seguro',
        'seguro',
        'autorizacion_viaje',
        'pasaporte_permanente',
        'pais_residencia',
        'archivos',
        'activo',
    ];

    protected $casts = [
        'fecha_nacimiento' => 'date',
        'vigencia_pasaporte' => 'date',
        'valido_visa' => 'date',
        'pasaporte' => 'boolean',
        'visado' => 'boolean',
        'vacunacion' => 'boolean',
        'vacunacion_fiebre_amarilla' => 'array',
        'tiene_seguro' => 'boolean',
        'archivos' => 'array',
        'activo' => 'boolean',
    ];

    public function ventas()
    {
        return $this->hasMany(Venta::class);
    }
}
