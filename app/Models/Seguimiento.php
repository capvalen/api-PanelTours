<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seguimiento extends Model
{
    use HasFactory;

    protected $table = 'seguimientos';

    protected $fillable = [
        'venta_id',
        'accion_id',
        'fecha',
        'id_usuario',
    ];

    protected $casts = [
        'fecha' => 'datetime',
    ];

    public function venta()
    {
        return $this->belongsTo(Venta::class, 'venta_id');
    }

    public function accion()
    {
        return $this->belongsTo(Accion::class, 'accion_id');
    }

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'id_usuario');
    }
}
