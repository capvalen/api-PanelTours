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
            // Cotización 3: Cusco - tour arqueológico
            [
                'cotizacion_id' => 3,
                'tipo' => 'tour',
                'descuento' => 0.00,
                'motivo_descuento' => null,
                'precio' => 1800.00,
                'descripcion' => 'Tour Valle Sagrado + Machu Picchu',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'cotizacion_id' => 3,
                'tipo' => 'hospedaje',
                'descuento' => 200.00,
                'motivo_descuento' => 'Paquete familiar',
                'precio' => 1400.00,
                'descripcion' => 'Hospedaje Cusco - 4 noches',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Cotización 4: Piura - playa
            [
                'cotizacion_id' => 4,
                'tipo' => 'hospedaje',
                'descuento' => 50.00,
                'motivo_descuento' => 'Cliente nuevo',
                'precio' => 500.00,
                'descripcion' => 'Hospedaje Máncora - 3 noches',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'cotizacion_id' => 4,
                'tipo' => 'restaurante',
                'descuento' => 0.00,
                'motivo_descuento' => null,
                'precio' => 300.00,
                'descripcion' => 'Plan alimenticio 3 días',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Cotización 5: Puno - Lago Titicaca
            [
                'cotizacion_id' => 5,
                'tipo' => 'tour',
                'descuento' => 0.00,
                'motivo_descuento' => null,
                'precio' => 1500.00,
                'descripcion' => 'Tour Islas Uros, Taquile y Amantaní',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'cotizacion_id' => 5,
                'tipo' => 'vuelo',
                'descuento' => 0.00,
                'motivo_descuento' => null,
                'precio' => 1300.00,
                'descripcion' => 'Vuelo Lima - Juliaca ida y vuelta',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
