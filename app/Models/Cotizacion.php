<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Cotizacion extends Model
{
    use HasFactory;

    protected $table = 'cotizacion';

    protected $fillable = [
        'usuario_id',
        'cliente_id',
        'fecha',
        'adults',
        'kids',
        'cuantas_personas',
        'departamento_id',
        'ciudad',
        'costo',
        'descuento',
        'motivo_descuento',
        'precio',
        'adelanto',
        'estado',
        'nacionalidad',
        'activo',
    ];

    protected $casts = [
        'costo' => 'decimal:2',
        'descuento' => 'decimal:2',
        'precio' => 'decimal:2',
        'adelanto' => 'decimal:2',
        'fecha' => 'datetime',
        'adults' => 'integer',
        'kids' => 'integer',
        'cuantas_personas' => 'integer',
        'activo' => 'boolean',
    ];

    protected $with = ['cliente', 'usuario'];

    protected static function booted()
    {
        static::addGlobalScope('activo', function (Builder $builder) {
            $builder->where('activo', 1);
        });
    }

    public function usuario()
    {
        return $this->belongsTo(Usuario::class);
    }

    public function cliente()
    {
        return $this->belongsTo(Cliente::class)->select(['id', 'ruc', 'razon_social', 'dni', 'nombres', 'apellidos', 'celular']);
    }

    public function departamento()
    {
        return $this->belongsTo(Departamento::class);
    }

    public function items()
    {
        return $this->hasMany(CotizacionItem::class);
    }
}
