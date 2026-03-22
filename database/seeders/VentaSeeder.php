<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VentaSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('ventas')->insert([
            [
                'cliente_id' => 1,
                'fecha' => '2026-03-21',
                'estado' => 'confirmada',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'cliente_id' => 2,
                'fecha' => '2026-03-20',
                'estado' => 'pagada',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'cliente_id' => 3,
                'fecha' => '2026-03-19',
                'estado' => 'cotizacion',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'cliente_id' => 4,
                'fecha' => '2026-03-18',
                'estado' => 'confirmada',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'cliente_id' => 1,
                'fecha' => '2026-03-15',
                'estado' => 'anulada',
                'activo' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
