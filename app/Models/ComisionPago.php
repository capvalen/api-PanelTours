<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ComisionPago extends Model
{
    use HasFactory;

    protected $table = 'comision_pagos';

    protected $fillable = [
        'comision_id',
        'fecha',
        'monto',
        'observaciones',
        'activo',
    ];

    protected $casts = [
        'fecha' => 'date:Y-m-d',
        'monto' => 'decimal:2',
        'activo' => 'boolean',
    ];

    protected static function booted()
    {
        static::addGlobalScope('activo', function (Builder $builder) {
            $builder->where('activo', 1);
        });
    }

    public function comision()
    {
        return $this->belongsTo(Comision::class);
    }
}
