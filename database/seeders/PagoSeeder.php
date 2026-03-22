<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PagoSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('pagos')->insert([
            [
                'venta_id' => 2,
                'fecha' => '2026-03-20 10:30:00',
                'es_compromiso' => false,
                'fecha_compromiso' => null,
                'monto_abonado' => 2350.00,
                'saldo_pendiente' => 0.00,
                'metodo_pago' => 'tarjeta',
                'estado_pago' => 'completado',
                'codigo_referencia' => 'VISA-2026032045678',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'venta_id' => 1,
                'fecha' => '2026-03-21 11:00:00',
                'es_compromiso' => false,
                'fecha_compromiso' => null,
                'monto_abonado' => 1000.00,
                'saldo_pendiente' => 1050.00,
                'metodo_pago' => 'yape',
                'estado_pago' => 'pendiente',
                'codigo_referencia' => null,
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'venta_id' => 4,
                'fecha' => '2026-03-20 15:00:00',
                'es_compromiso' => false,
                'fecha_compromiso' => null,
                'monto_abonado' => 1050.50,
                'saldo_pendiente' => 749.50,
                'metodo_pago' => 'depósito',
                'estado_pago' => 'pendiente',
                'codigo_referencia' => 'BCP-OP20260320-789',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'venta_id' => 4,
                'fecha' => '2026-03-21 09:00:00',
                'es_compromiso' => true,
                'fecha_compromiso' => '2026-03-25',
                'monto_abonado' => 0.00,
                'saldo_pendiente' => 749.50,
                'metodo_pago' => 'efectivo',
                'estado_pago' => 'pendiente',
                'codigo_referencia' => null,
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
