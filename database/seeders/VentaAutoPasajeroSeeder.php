<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VentaAutoPasajeroSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('venta_autos_pasajeros')->insert([
            [
                'venta_auto_id' => 1,
                'numero_asiento' => '1',
                'dni' => '72345678',
                'nombre' => 'Luis Alberto Vargas Medina',
                
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'venta_auto_id' => 1,
                'numero_asiento' => '2',
                'dni' => '73456789',
                'nombre' => 'Elena Vargas Torres',
                
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
