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
        ]);
    }
}
