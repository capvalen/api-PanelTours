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
        'usuario_id',
        'cliente_id',
        'fecha',
        'estado_pago',
        'adults',
        'kids',
        'cuantas_personas',
        'departamento_id',
        'ciudad',
        'fecha_inicio',
        'fecha_fin',
        'costo',
        'descuento',
        'motivo_descuento',
        'precio',
        'precio_adultos',
        'precio_kids',
        'adelanto',
        'nivel',
        'estado',
        'progreso',
        'nacionalidad',
        'autorizaciones',
        'activo',
    ];

    protected $casts = [
        'costo' => 'decimal:2',
        'descuento' => 'decimal:2',
        'precio' => 'decimal:2',
        'precio_adultos' => 'decimal:2',
        'precio_kids' => 'decimal:2',
        'adelanto' => 'decimal:2',
        'fecha' => 'datetime',
        'fecha_inicio' => 'date',
        'fecha_fin' => 'date',
        'adults' => 'integer',
        'kids' => 'integer',
        'cuantas_personas' => 'integer',
        'autorizaciones' => 'array',
        'activo' => 'boolean',
    ];

    protected $with = ['cliente', 'usuario'];

		// Global Scope para filtrar solo activos
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

    public function personas()
    {
        return $this->hasMany(Persona::class);
    }

    public function seguimientos()
    {
        return $this->hasMany(Seguimiento::class, 'venta_id');
    }
}
