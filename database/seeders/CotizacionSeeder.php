<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CotizacionSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('cotizacion')->insert([
            [
                'usuario_id' => 1,
                'cliente_id' => 1,
                'fecha' => '2026-05-20',
                'adults' => 2,
                'kids' => 1,
                'cuantas_personas' => 3,
                'precio' => 1100,
                'adelanto' => 0,
                'costo' => 900,
                'descuento' => 50,
                'motivo_descuento' => 'Campaña familiar',
                'departamento_id' => 15, // Lima
                'ciudad' => 'Lima',
                'estado' => 'activo',
                'nacionalidad' => 'peruana',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'usuario_id' => 2,
                'cliente_id' => 2,
                'fecha' => '2026-05-21',
                'adults' => 2,
                'kids' => 0,
                'cuantas_personas' => 2,
                'precio' => 1500,
                'adelanto' => 0,
                'costo' => 1300,
                'descuento' => 0,
                'motivo_descuento' => null,
                'departamento_id' => 4, // Arequipa
                'ciudad' => 'Arequipa',
                'estado' => 'activo',
                'nacionalidad' => 'extranjera',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Cotización 3: Cusco - tour arqueológico
            [
                'usuario_id' => 3,
                'cliente_id' => 3,
                'fecha' => '2026-06-10',
                'adults' => 3,
                'kids' => 1,
                'cuantas_personas' => 4,
                'precio' => 3200,
                'adelanto' => 500,
                'costo' => 2600,
                'descuento' => 0,
                'motivo_descuento' => null,
                'departamento_id' => 8, // Cusco
                'ciudad' => 'Cusco',
                'estado' => 'activo',
                'nacionalidad' => 'peruana',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Cotización 4: Piura - turismo de playa
            [
                'usuario_id' => 1,
                'cliente_id' => 4,
                'fecha' => '2026-06-12',
                'adults' => 2,
                'kids' => 0,
                'cuantas_personas' => 2,
                'precio' => 800,
                'adelanto' => 0,
                'costo' => 600,
                'descuento' => 50,
                'motivo_descuento' => 'Cliente nuevo',
                'departamento_id' => 20, // Piura
                'ciudad' => 'Máncora',
                'estado' => 'activo',
                'nacionalidad' => 'peruana',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Cotización 5: Puno - Lake Titicaca
            [
                'usuario_id' => 2,
                'cliente_id' => 5,
                'fecha' => '2026-06-15',
                'adults' => 5,
                'kids' => 1,
                'cuantas_personas' => 6,
                'precio' => 2800,
                'adelanto' => 1000,
                'costo' => 2200,
                'descuento' => 0,
                'motivo_descuento' => null,
                'departamento_id' => 21, // Puno
                'ciudad' => 'Puno',
                'estado' => 'activo',
                'nacionalidad' => 'extranjera',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
