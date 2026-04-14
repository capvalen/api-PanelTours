<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VentaSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('ventas')->insert([
            [
                'cliente_id' => 1,
                'fecha' => '2026-03-21',
                'tipo' => 'venta',
                'estado_pago' => 'pendiente',
                'precio' => 1250,
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'cliente_id' => 2,
                'fecha' => '2026-03-20',
                'tipo' => 'venta',
                'estado_pago' => 'completo',
                'activo' => true,
                'precio' => 2350,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'cliente_id' => 3,
                'fecha' => '2026-03-19',
                'tipo' => 'cotización',
                'estado_pago' => 'pendiente',
                'precio' => 400,
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'cliente_id' => 4,
                'fecha' => '2026-03-18',
                'tipo' => 'venta',
                'estado_pago' => 'adelantado',
                'precio' => 1800,
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'cliente_id' => 1,
                'fecha' => '2026-03-15',
                'tipo' => 'venta',
                'estado_pago' => 'anulado',
                'activo' => false,
                'precio' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
