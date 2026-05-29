<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CotizacionItemSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('cotizacion_items')->insert([
            [
                'cotizacion_id' => 1,
                'tipo' => 'vuelo',
                'descuento' => 10.00,
                'motivo_descuento' => 'Descuento especial',
                'precio' => 500.00,
                'descripcion' => 'Vuelo Cusco ida y vuelta',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'cotizacion_id' => 1,
                'tipo' => 'hospedaje',
                'descuento' => 0.00,
                'motivo_descuento' => null,
                'precio' => 600.00,
                'descripcion' => 'Hospedaje Cusco - 3 noches',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'cotizacion_id' => 2,
                'tipo' => 'tour',
                'descuento' => 0.00,
                'motivo_descuento' => null,
                'precio' => 1500.00,
                'descripcion' => 'Tour completo Arequipa y Colca',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
