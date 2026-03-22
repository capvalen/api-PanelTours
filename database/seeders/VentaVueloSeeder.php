<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VentaVueloSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('venta_vuelos')->insert([
            [
                'venta_item_id' => 1, // Venta 1 - vuelo Lima-Cusco
                'tipo_viaje' => 'ida_vuelta',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'venta_item_id' => 3, // Venta 2 - vuelo Lima-Cusco-Puerto Maldonado
                'tipo_viaje' => 'ida_vuelta',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'venta_item_id' => 7, // Venta 4 - vuelo Lima-Juliaca
                'tipo_viaje' => 'ida_vuelta',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
