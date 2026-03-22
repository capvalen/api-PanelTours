<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AerolineaSeeder extends Seeder
{
    public function run(): void
    {
        $aerolineas = ['LATAM Airlines', 'Sky Airline', 'JetSmart', 'Viva Air', 'Star Perú'];

        foreach ($aerolineas as $nombre) {
            DB::table('aerolineas')->insert([
                'nombre' => $nombre,
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
