<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    use HasFactory;

    protected $table = 'proveedores';

    protected $fillable = [
        'ruc',
        'razon_social',
        'direccion',
        'ciudad',
        'contacto',
        'celular',
        'banco',
        'numero_cuenta',
        'categoria',
        'archivos',
        'activo',
    ];

    protected $casts = [
        'archivos' => 'array',
        'activo' => 'boolean',
    ];

		public function deudas(){
			return $this->hasMany(Deuda::class, 'proveedor_id')->where('activo', 1);;
		}

		public function getArchivosAttribute($value)
		{
			return $value ? json_decode($value, true) : [];
		}
}
