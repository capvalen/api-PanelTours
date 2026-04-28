<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VentaItemSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('venta_items')->insert([
            // Venta 1 - Cliente Flores: vuelo + hospedaje
            [
                'venta_id' => 1,
                'tipo' => 'vuelo',
                'nro_clientes' => 2,
                'precio' => 850.00,
                'descripcion' => 'Vuelo Lima - Cusco ida y vuelta',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'venta_id' => 1,
                'tipo' => 'hospedaje',
                'nro_clientes' => 2,
                'precio' => 1200.00,
                'descripcion' => 'Hospedaje Hotel Libertador Cusco - 4 noches',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Venta 2 - Cliente Johnson: vuelo + turismo + restaurante
            [
                'venta_id' => 2,
                'tipo' => 'vuelo',
                'nro_clientes' => 3,
                'precio' => 1500.00,
                'descripcion' => 'Vuelo Lima - Cusco - Puerto Maldonado ida y vuelta',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'venta_id' => 2,
                'tipo' => 'turismo',
                'nro_clientes' => 3,
                'precio' => 600.00,
                'descripcion' => 'Tour Machu Picchu día completo',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'venta_id' => 2,
                'tipo' => 'restaurante',
                'nro_clientes' => 3,
                'precio' => 250.00,
                'descripcion' => 'Plan alimenticio 5 días - Restaurante La Mar',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Venta 3 - cotización: solo auto
            [
                'venta_id' => 3,
                'tipo' => 'transporte',
                'nro_clientes' => 1,
                'precio' => 400.00,
                'descripcion' => 'Alquiler SUV - 3 días Arequipa',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Venta 4 - paquete completo
            [
                'venta_id' => 4,
                'tipo' => 'vuelo',
                'nro_clientes' => 4,
                'precio' => 650.00,
                'descripcion' => 'Vuelo Lima - Juliaca ida y vuelta',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'venta_id' => 4,
                'tipo' => 'hospedaje',
                'nro_clientes' => 4,
                'precio' => 800.00,
                'descripcion' => 'Hospedaje en Puno - 3 noches',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'venta_id' => 4,
                'tipo' => 'turismo',
                'nro_clientes' => 4,
                'precio' => 350.00,
                'descripcion' => 'Tour Islas Uros y Taquile',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
