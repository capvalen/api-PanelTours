<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Restaurante extends Model
{
    use HasFactory;

    protected $table = 'restaurantes';

    protected $fillable = [
        'ruc',
        'nombre',
        'departamento_id',
        'direccion',
        'contacto',
        'celular',
        'archivos',
        'activo',
    ];

    protected $casts = [
        'archivos' => 'array',
        'activo' => 'boolean',
    ];

    public function departamento()
    {
        return $this->belongsTo(Departamento::class);
    }
    public function getArchivosAttribute($value)
    {
        return $value ? json_decode($value, true) : [];
    }
}
