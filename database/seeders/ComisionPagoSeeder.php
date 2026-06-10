<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ComisionPagoSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('comision_pagos')->insert([
            // Comisión 2 (Log 1, Vehículo, estado pagado) — pago completo
            [
                'comision_id' => 2,
                'fecha' => '2026-05-30',
                'monto' => 20.00,
                'observaciones' => 'Pago completo transporte Tour Selva Central',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Comisión 3 (Log 2, Guía, estado pendiente) — adelanto
            [
                'comision_id' => 3,
                'fecha' => '2026-06-04',
                'monto' => 50.00,
                'observaciones' => 'Adelanto City Tour Arequipa',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Comisión 5 (Log 3, Guía, estado adelantado) — adelanto
            [
                'comision_id' => 5,
                'fecha' => '2026-06-08',
                'monto' => 100.00,
                'observaciones' => 'Adelanto Tour Lago Titicaca',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
