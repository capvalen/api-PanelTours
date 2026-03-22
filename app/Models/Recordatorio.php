<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recordatorio extends Model
{
    use HasFactory;

    protected $table = 'recordatorios';

    protected $fillable = [
        'tipo_evento',
        'fecha_hora',
        'estado',
        'titulo',
        'comentario',
        'usuario_id',
        'activo',
    ];

    protected $casts = [
        'fecha_hora' => 'datetime',
        'activo' => 'boolean',
    ];

    public function usuario()
    {
        return $this->belongsTo(Usuario::class);
    }
}
