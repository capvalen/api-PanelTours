<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CobroAbono extends Model
{
    use HasFactory;

    protected $table = 'cobro_abonos';

    protected $fillable = [
        'cobro_id',
        'fecha',
        'monto',
        'metodo_pago',
        'codigo_referencia',
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

    public function cobro()
    {
        return $this->belongsTo(Pago::class, 'cobro_id');
    }
}