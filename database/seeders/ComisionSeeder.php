<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ComisionSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('comisiones')->insert([
            // Logística 1: Tour Selva Central — guía
            [
                'fecha' => '2026-05-30',
                'logistica_id' => 1,
                'cant_personas' => 4,
                'monto' => 20.00,
                'estado_pago' => 'pagado',
                'observaciones' => 'Tour Selva Central',
                'comisionable_id' => 2,
                'comisionable_type' => 'App\Models\Guia',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Logística 1: Tour Selva Central — vehículo
            [
                'fecha' => '2026-05-30',
                'logistica_id' => 1,
                'cant_personas' => 4,
                'monto' => 20.00,
                'estado_pago' => 'pagado',
                'observaciones' => 'Tour Selva Central',
                'comisionable_id' => 2,
                'comisionable_type' => 'App\Models\Vehiculo',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Logística 2: City Tour Arequipa — guía
            [
                'fecha' => '2026-06-05',
                'logistica_id' => 2,
                'cant_personas' => 5,
                'monto' => 180.00,
                'estado_pago' => 'pendiente',
                'observaciones' => 'City Tour Arequipa',
                'comisionable_id' => 3,
                'comisionable_type' => 'App\Models\Guia',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Logística 2: City Tour Arequipa — vehículo
            [
                'fecha' => '2026-06-05',
                'logistica_id' => 2,
                'cant_personas' => 5,
                'monto' => 180.00,
                'estado_pago' => 'pendiente',
                'observaciones' => 'City Tour Arequipa',
                'comisionable_id' => 3,
                'comisionable_type' => 'App\Models\Vehiculo',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Logística 3: Tour Lago Titicaca — guía
            [
                'fecha' => '2026-06-10',
                'logistica_id' => 3,
                'cant_personas' => 3,
                'monto' => 250.00,
                'estado_pago' => 'adelantado',
                'observaciones' => 'Tour Lago Titicaca',
                'comisionable_id' => 5,
                'comisionable_type' => 'App\Models\Guia',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
