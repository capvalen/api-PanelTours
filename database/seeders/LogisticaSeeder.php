<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LogisticaSeeder extends Seeder
{
    public function run(): void
    {
        $fecha1 = '2026-05-30';

        // Venta 6: pagado completo (para logística 1)
        DB::table('ventas')->insert([
            'id' => 6,
            'usuario_id' => 1,
            'cliente_id' => 1,
            'departamento_id' => 1,
            'fecha' => $fecha1,
            'adelanto' => 100,
            'precio' => 100,
            'nivel' => 2,
            'estado' => 'activo',
            'estado_pago' => 'pagado',
            'adults' => 2,
            'cuantas_personas' => 2,
            'autorizaciones' => '{}',
            'activo' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('venta_items')->insert([
            'venta_id' => 6,
            'tipo' => 'tour',
            'descripcion' => 'Tour Selva Central',
            'precio_adulto' => 50,
            'precio' => 100,
            'activo' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('pagos')->insert([
            'venta_id' => 6,
            'fecha' => $fecha1,
            'monto_abonado' => 100,
            'saldo_pendiente' => 0,
            'metodo_pago' => 'efectivo',
            'estado_pago' => 'pagado',
            'activo' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Venta 7: adelanto (para logística 1)
        DB::table('ventas')->insert([
            'id' => 7,
            'usuario_id' => 1,
            'cliente_id' => 1,
            'departamento_id' => 1,
            'fecha' => $fecha1,
            'adelanto' => 10,
            'precio' => 100,
            'nivel' => 2,
            'estado' => 'activo',
            'estado_pago' => 'adelantado',
            'adults' => 2,
            'cuantas_personas' => 2,
            'autorizaciones' => '{}',
            'activo' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('venta_items')->insert([
            'venta_id' => 7,
            'tipo' => 'tour',
            'descripcion' => 'Tour Selva Central',
            'precio_adulto' => 50,
            'precio' => 100,
            'activo' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('pagos')->insert([
            'venta_id' => 7,
            'fecha' => $fecha1,
            'monto_abonado' => 10,
            'saldo_pendiente' => 90,
            'metodo_pago' => 'yape',
            'estado_pago' => 'adelantado',
            'activo' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Logística 1: Tour Selva Central — finalizado, con guía y vehículo
        DB::table('logistica')->insert([
            'id' => 1,
            'fecha' => $fecha1,
            'titulo' => 'Tour Selva Central',
            'estado' => 'finalizado',
            'destino' => 'Lima - El Callao',
            'guia_id' => 2,
            'vehiculo_id' => 2,
            'hora' => '08:00:00',
            'lugar' => 'Hotel Sheraton Lima',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('logistica_ventas')->insert([
            ['logistica_id' => 1, 'venta_id' => 6],
            ['logistica_id' => 1, 'venta_id' => 7],
        ]);

        // ─────────────────────────────────────────────

        $fecha2 = '2026-06-05';

        // Logística 2: City Tour Arequipa — pendiente, con guía y vehículo
        DB::table('logistica')->insert([
            'id' => 2,
            'fecha' => $fecha2,
            'titulo' => 'City Tour Arequipa',
            'estado' => 'pendiente',
            'destino' => 'Arequipa',
            'guia_id' => 3,
            'vehiculo_id' => 3,
            'hora' => '09:30:00',
            'lugar' => 'Plaza de Armas Arequipa',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('logistica_ventas')->insert([
            'logistica_id' => 2, 'venta_id' => 8,
        ]);

        // ─────────────────────────────────────────────

        $fecha3 = '2026-06-10';

        // Logística 3: Tour Lago Titicaca — pendiente, solo guía
        DB::table('logistica')->insert([
            'id' => 3,
            'fecha' => $fecha3,
            'titulo' => 'Tour Lago Titicaca',
            'estado' => 'pendiente',
            'destino' => 'Puno',
            'guia_id' => 5,
            'vehiculo_id' => null,
            'hora' => '07:00:00',
            'lugar' => 'Terminal Terrestre Puno',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('logistica_ventas')->insert([
            'logistica_id' => 3, 'venta_id' => 9,
        ]);
    }
}
