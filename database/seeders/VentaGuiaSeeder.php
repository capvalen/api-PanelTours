<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VentaGuiaSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('venta_guias')->insert([
            [
                'venta_item_id' => 4, // Tour Machu Picchu
                'guia_id' => 1, // Miguel Ángel Condori - Cusco

                'fecha' => '2026-04-07',
                'hora' => '04:30:00',
                'lugar_encuentro' => 'Lobby Hotel Libertador Cusco',

                'costo' => 120.00,

                'tipo_servicio' => 'privado',


                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'venta_item_id' => 9, // Tour Islas Uros y Taquile
                'guia_id' => 4, // Patricia Mamani - Puno

                'fecha' => '2026-04-11',
                'hora' => '06:45:00',
                'lugar_encuentro' => 'Puerto lacustre de Puno, muelle principal',

                'costo' => 80.00,

                'tipo_servicio' => 'grupal',


                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
