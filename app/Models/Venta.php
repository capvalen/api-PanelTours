<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Venta extends Model
{
    use HasFactory;

    protected $table = 'ventas';

    protected $fillable = [
        'cliente_id',
        'fecha',
        'tipo',
        'estado_pago',
				'personas',
				'departamento_id',
				'ciudad',
        'precio',
        'nivel',
        'estado',
        'activo',
    ];

    protected $casts = [
        'precio' => 'decimal:2',
        'fecha' => 'datetime',
        'activo' => 'boolean',
    ];

    protected $with = ['cliente'];

		// Global Scope para filtrar solo activos
		protected static function booted()
		{
			static::addGlobalScope('activo', function (Builder $builder) {
				$builder->where('activo', 1);
			});
		}

    public function cliente()
    {
        return $this->belongsTo(Cliente::class)->select(['id', 'ruc', 'razon_social', 'dni', 'nombres', 'apellidos']);
    }

    public function departamento()
    {
        return $this->belongsTo(Departamento::class);
    }
    public function items()
    {
        return $this->hasMany(VentaItem::class);
    }

    public function pagos()
    {
        return $this->hasMany(Pago::class);
    }

    public function cajaDetalles()
    {
        return $this->hasMany(CajaDetalle::class);
    }
}
