<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Logistica extends Model
{
    use HasFactory;

    protected $table = 'logistica';

    protected $fillable = [
        'fecha',
        'titulo',
        'estado',
        'destino',
        'usuario_id',
        'hora',
        'lugar',
        'guia_id',
        'vehiculo_id',
    ];

    protected $casts = [
        'fecha' => 'date',
        'hora' => 'string',
    ];

    public function ventas()
    {
        return $this->belongsToMany(Venta::class, 'logistica_ventas', 'logistica_id', 'venta_id');
    }

    public function usuario()
    {
        return $this->belongsTo(Usuario::class);
    }

    public function guia()
    {
        return $this->belongsTo(Guia::class);
    }

    public function vehiculo()
    {
        return $this->belongsTo(Vehiculo::class);
    }
}
