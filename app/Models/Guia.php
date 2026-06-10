<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guia extends Model
{
    use HasFactory;

    protected $table = 'guias';

    protected $fillable = [
        'dni',
        'nombre',
        'celular',
        'contacto_emergencia',
        'banco',
        'numero_cuenta',
        'aplicativo',
        'propietario_aplicativo',
        'especialidad',
        'idiomas',
        'departamento_id',
        'activo',
    ];

    protected $with = ['departamento'];

    protected $casts = [
        'activo' => 'boolean',
    ];

    public function departamento()
    {
        return $this->belongsTo(Departamento::class);
    }

    public function ventaGuias()
    {
        return $this->hasMany(VentaGuia::class);
    }

    public function comisiones()
    {
        return $this->morphMany(Comision::class, 'comisionable');
    }
}
