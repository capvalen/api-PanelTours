<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Venta;
use App\Models\VentaItem;
use App\Models\Pago;
use App\Models\Logistica;
use App\Models\LogisticaVenta;

class LogisticaSeeder extends Seeder
{
    public function run(): void
    {
        $fecha = '2026-05-30';

        // Venta 1: pagado completo
        $venta1 = Venta::create([
            'usuario_id' => 1,
            'cliente_id' => 1,
            'departamento_id' => 1,
            'fecha' => $fecha,
            'adelanto' => 100,
            'precio' => 100,
            'nivel' => 2,
            'estado' => 'activo',
            'estado_pago' => 'pagado',
            'adults' => 2,
            'cuantas_personas' => 2,
        ]);

        VentaItem::create([
            'venta_id' => $venta1->id,
            'tipo' => 'tour',
            'descripcion' => 'Tour Selva Central',
            'precio_adulto' => 50,
            'precio_kids' => 0,
            'precio' => 100,
        ]);

        Pago::create([
            'venta_id' => $venta1->id,
            'fecha' => $fecha,
            'monto_abonado' => 100,
            'saldo_pendiente' => 0,
            'metodo_pago' => 'efectivo',
            'estado_pago' => 'pagado',
            'activo' => 1,
        ]);

        // Venta 2: solo adelanto 10 de 100
        $venta2 = Venta::create([
            'usuario_id' => 1,
            'cliente_id' => 1,
            'departamento_id' => 1,
            'fecha' => $fecha,
            'adelanto' => 10,
            'precio' => 100,
            'nivel' => 2,
            'estado' => 'activo',
            'estado_pago' => 'adelantado',
            'adults' => 2,
            'cuantas_personas' => 2,
        ]);

        VentaItem::create([
            'venta_id' => $venta2->id,
            'tipo' => 'tour',
            'descripcion' => 'Tour Selva Central',
            'precio_adulto' => 50,
            'precio_kids' => 0,
            'precio' => 100,
        ]);

        Pago::create([
            'venta_id' => $venta2->id,
            'fecha' => $fecha,
            'monto_abonado' => 10,
            'saldo_pendiente' => 90,
            'metodo_pago' => 'yape',
            'estado_pago' => 'adelantado',
            'activo' => 1,
        ]);

        // Logistica
        $logistica = Logistica::create([
            'fecha' => $fecha,
            'titulo' => 'Tour Selva Central',
            'estado' => 'pendiente',
            'destino' => 'Lima - El Callao',
        ]);

        // Vincular ambas ventas
        LogisticaVenta::create([
            'logistica_id' => $logistica->id,
            'venta_id' => $venta1->id,
        ]);

        LogisticaVenta::create([
            'logistica_id' => $logistica->id,
            'venta_id' => $venta2->id,
        ]);
    }
}
