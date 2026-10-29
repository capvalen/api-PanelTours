<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Caja extends Model
{
    use HasFactory;

    protected $table = 'cajas';

    protected $fillable = [
        'usuario_id',
        'fecha_apertura',
        'fecha_cierre',
        'monto_inicial',
        'monto_final',
        'estado',
        'observaciones',
        'activo',
    ];

    protected $casts = [
        'fecha_apertura' => 'datetime',
        'fecha_cierre' => 'datetime',
        'monto_inicial' => 'decimal:2',
        'monto_final' => 'decimal:2',
        'activo' => 'boolean',
    ];

    /**
     * Si llega solo la fecha (o vacía) se completa con la hora actual de
     * America/Lima para que no se guarde a las 00:00:00.
     */
    public function setFechaAperturaAttribute($value)
    {
        $this->attributes['fecha_apertura'] = $this->normalizarFecha($value) ?? now();
    }

    public function setFechaCierreAttribute($value)
    {
        $this->attributes['fecha_cierre'] = $value ? $this->normalizarFecha($value) : null;
    }

    private function normalizarFecha($value)
    {
        if (empty($value)) {
            return null;
        }

        if (is_string($value) && preg_match('/^\d{4}-\d{2}-\d{2}$/', trim($value))) {
            return trim($value) . ' ' . now()->format('H:i:s');
        }

        if ($value instanceof \DateTimeInterface) {
            return $value->format('Y-m-d H:i:s');
        }

        return $value;
    }

    public function usuario()
    {
        return $this->belongsTo(Usuario::class);
    }

    public function detalles()
    {
        return $this->hasMany(CajaDetalle::class);
    }
}
