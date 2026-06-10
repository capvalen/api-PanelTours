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

    public function generarComisiones($monto = null)
    {
        $ventas = $this->ventas()->get();
        $totalPrecio = $monto ?? $ventas->sum('precio');
        $totalPersonas = $ventas->sum('cuantas_personas');

        if ($this->guia_id) {
            $this->crearComision($this->guia_id, 'App\Models\Guia', $totalPrecio, $totalPersonas);
        }

        if ($this->vehiculo_id) {
            $this->crearComision($this->vehiculo_id, 'App\Models\Vehiculo', $totalPrecio, $totalPersonas);
        }
    }

    protected function crearComision($comisionableId, $comisionableType, $totalPrecio, $totalPersonas)
    {
        $existe = Comision::where('logistica_id', $this->id)
            ->where('comisionable_id', $comisionableId)
            ->where('comisionable_type', $comisionableType)
            ->where('activo', 1)
            ->exists();

        if ($existe) {
            return;
        }

        Comision::create([
            'fecha' => $this->fecha,
            'logistica_id' => $this->id,
            'cant_personas' => $totalPersonas,
            'monto' => (float) $totalPrecio * 0.10,
            'estado_pago' => 'pendiente',
            'observaciones' => $this->titulo,
            'comisionable_id' => $comisionableId,
            'comisionable_type' => $comisionableType,
            'activo' => true,
        ]);
    }

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
