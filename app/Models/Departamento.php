<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Departamento extends Model
{
    use HasFactory;

    protected $table = 'departamentos';

    protected $fillable = [
        'departamento',
        'activo',
    ];

    protected $casts = [
        'activo' => 'boolean',
    ];

    public function guias()
    {
        return $this->hasMany(Guia::class);
    }

    public function hospedajes()
    {
        return $this->hasMany(Hospedaje::class);
    }

    public function restaurantes()
    {
        return $this->hasMany(Restaurante::class);
    }
}
