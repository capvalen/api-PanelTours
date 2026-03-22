<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CajaSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('cajas')->insert([
            [
                'usuario_id' => 1,
                'fecha_apertura' => '2026-03-21 08:00:00',
                'fecha_cierre' => null,
                'monto_inicial' => 500.00,
                'monto_final' => null,
                'estado' => 'abierta',
                'observaciones' => 'Apertura de caja turno mañana',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'usuario_id' => 2,
                'fecha_apertura' => '2026-03-20 08:00:00',
                'fecha_cierre' => '2026-03-20 18:00:00',
                'monto_inicial' => 500.00,
                'monto_final' => 3250.50,
                'estado' => 'cerrada',
                'observaciones' => 'Cierre normal, cuadre correcto',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
