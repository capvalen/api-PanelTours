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
                'descuento' => 0.00,
                'motivo_descuento' => null,
                'precio' => 850.00,
                'descripcion' => 'Vuelo Lima - Cusco ida y vuelta',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'venta_id' => 1,
                'tipo' => 'hospedaje',
                'descuento' => 0.00,
                'motivo_descuento' => null,
                'precio' => 1200.00,
                'descripcion' => 'Hospedaje Hotel Libertador Cusco - 4 noches',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Venta 2 - Cliente Johnson: vuelo + tour + restaurante
            [
                'venta_id' => 2,
                'tipo' => 'vuelo',
                'descuento' => 50.00,
                'motivo_descuento' => 'Descuento paquete',
                'precio' => 1500.00,
                'descripcion' => 'Vuelo Lima - Cusco - Puerto Maldonado ida y vuelta',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'venta_id' => 2,
                'tipo' => 'tour',
                'descuento' => 0.00,
                'motivo_descuento' => null,
                'precio' => 600.00,
                'descripcion' => 'Tour Machu Picchu día completo',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'venta_id' => 2,
                'tipo' => 'restaurante',
                'descuento' => 0.00,
                'motivo_descuento' => null,
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
                'descuento' => 0.00,
                'motivo_descuento' => null,
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
                'descuento' => 20.00,
                'motivo_descuento' => 'Dscto especial',
                'precio' => 650.00,
                'descripcion' => 'Vuelo Lima - Juliaca ida y vuelta',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'venta_id' => 4,
                'tipo' => 'hospedaje',
                'descuento' => 0.00,
                'motivo_descuento' => null,
                'precio' => 800.00,
                'descripcion' => 'Hospedaje en Puno - 3 noches',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'venta_id' => 4,
                'tipo' => 'tour',
                'descuento' => 0.00,
                'motivo_descuento' => null,
                'precio' => 350.00,
                'descripcion' => 'Tour Islas Uros y Taquile',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Venta 8: Arequipa
            [
                'venta_id' => 8,
                'tipo' => 'tour',
                'descuento' => 0.00,
                'motivo_descuento' => null,
                'precio' => 1000.00,
                'descripcion' => 'City Tour Arequipa + Monasterio Santa Catalina',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'venta_id' => 8,
                'tipo' => 'restaurante',
                'descuento' => 0.00,
                'motivo_descuento' => null,
                'precio' => 800.00,
                'descripcion' => 'Plan alimenticio 2 días',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Venta 9: Cusco
            [
                'venta_id' => 9,
                'tipo' => 'tour',
                'descuento' => 0.00,
                'motivo_descuento' => null,
                'precio' => 1500.00,
                'descripcion' => 'Tour Valle Sagrado día completo',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'venta_id' => 9,
                'tipo' => 'hospedaje',
                'descuento' => 0.00,
                'motivo_descuento' => null,
                'precio' => 1000.00,
                'descripcion' => 'Hospedaje Cusco - 3 noches',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
