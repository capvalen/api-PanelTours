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
        'fecha_nacimiento',
        'correo',
        'celular',
        'telefono',
        'direccion',
        'nacionalidad',
        'pais_origen',
        'pasaporte',
        'vigencia_pasaporte',
        'valido_visa',
        'vacunas',
        'seguros',
        'autorizacion_viaje',
        'tipo_visado',
        'archivos',
        'activo',
    ];

    protected $casts = [
        'fecha_nacimiento' => 'date',
        'vigencia_pasaporte' => 'date',
        'valido_visa' => 'date',
        'vacunas' => 'array',
        'seguros' => 'array',
        'archivos' => 'array',
        'activo' => 'boolean',
    ];

    public function ventas()
    {
        return $this->hasMany(Venta::class);
    }
}
