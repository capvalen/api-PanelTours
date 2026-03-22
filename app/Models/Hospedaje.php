<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hospedaje extends Model
{
    use HasFactory;

    protected $table = 'hospedajes';

    protected $fillable = [
        'hospedaje',
        'direccion',
        'contacto',
        'celular',
        'correo',
        'departamento_id',
        'incluye_desayuno',
        'incluye_estacionamiento',
        'incluye_wifi',
        'servicios_extra',
        'activo',
    ];

    protected $casts = [
        'incluye_desayuno' => 'boolean',
        'incluye_estacionamiento' => 'boolean',
        'incluye_wifi' => 'boolean',
        'activo' => 'boolean',
    ];

    public function departamento()
    {
        return $this->belongsTo(Departamento::class);
    }

    public function ventaHospedajes()
    {
        return $this->hasMany(VentaHospedaje::class);
    }
}
