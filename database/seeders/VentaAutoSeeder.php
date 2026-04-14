<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VentaAutoSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('venta_autos')->insert([
            [
                'venta_item_id' => 6, // Venta 3 - Alquiler SUV Arequipa
                'vehiculo_id' => 2,   // SUV DEF-456
                'origen' => 'Aeropuerto de Arequipa (AQP)',
                'destino' => 'Oficina Centro Arequipa',
                'fecha_inicio' => '2026-04-01',
                'fecha_fin' => '2026-04-03',
                'hora_recogida' => '08:00:00',
                'hora_devolucion' => '18:00:00',
                'estado_alquiler' => 'reservado',
                'costo' => 400.00,
                'precio' => 280.00,
                'observaciones' => 'Recoger en aeropuerto de Arequipa, devolver en oficina centro',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
