<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    use HasFactory;

    protected $table = 'personas';

    protected $fillable = [
        'venta_id',
        'es_titular',
        'dni',
        'nombre',
        'fecha_nacimiento',
        'parentesco',
        'enfermedades',
        'detalle_enfermedades',
        'pasaporte',
        'fecha_caducidad_pasaporte',
        'pais_emision',
        'vacunas',
        'detalle_vacunas',
        'observaciones'
    ];

    protected $casts = [
        'fecha_nacimiento' => 'date',
        'fecha_caducidad_pasaporte' => 'date',
        'es_titular' => 'boolean',
        'activo' => 'boolean',
    ];

    public function venta()
    {
        return $this->belongsTo(Venta::class);
    }
}
