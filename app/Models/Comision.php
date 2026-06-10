<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comision extends Model
{
    use HasFactory;

    protected $table = 'comisiones';

    protected $fillable = [
        'fecha',
        'venta_id',
        'logistica_id',
        'cant_personas',
        'monto',
        'estado_pago',
        'observaciones',
        'comisionable_id',
        'comisionable_type',
        'activo',
    ];

    protected $casts = [
        'fecha' => 'date:Y-m-d',
        'monto' => 'decimal:2',
        'activo' => 'boolean',
    ];

    protected $with = ['comisionable'];

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

    public function logistica()
    {
        return $this->belongsTo(Logistica::class);
    }

    public function comisionable()
    {
        return $this->morphTo();
    }

    public function pagos()
    {
        return $this->hasMany(ComisionPago::class);
    }
}
