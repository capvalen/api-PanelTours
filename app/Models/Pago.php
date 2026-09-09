<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pago extends Model
{
    use HasFactory;

    protected $table = 'pagos';

    protected $fillable = [
        'venta_id',
        'proveedor_id',
        'fecha',
        'es_compromiso',
        'fecha_compromiso',
        'monto_abonado',
        'saldo_pendiente',
        'metodo_pago',
        'estado_pago',
        'es_cobro',
        'codigo_referencia',
        'concepto',
        'archivos',
        'activo',
    ];

    protected $casts = [
        'fecha' => 'datetime',
        'es_compromiso' => 'boolean',
        'fecha_compromiso' => 'date',
        'monto_abonado' => 'decimal:2',
        'saldo_pendiente' => 'decimal:2',
        'es_cobro' => 'boolean',
        'archivos' => 'array',
        'activo' => 'boolean',
    ];

    protected static function booted()
    {
        static::addGlobalScope('activo', function (Builder $builder) {
            $builder->where('activo', 1);
        });
    }

    public function venta()
    {
        return $this->belongsTo(Venta::class);
    }

    public function proveedor()
    {
        return $this->belongsTo(Proveedor::class);
    }

    public function abonos()
    {
        return $this->hasMany(CobroAbono::class, 'cobro_id');
    }

    public function getArchivosAttribute($value)
    {
        return $value ? json_decode($value, true) : [];
    }
}
