<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VueloSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('vuelos')->insert([
            ['vuelo' => 'Jauja - lima. 25/06/2026 3 am','activo' => true, 'created_at' => now(), 'updated_at' => now()],
            ['vuelo' => 'CUZ - IQU. 14:00 a 25 soles c/u', 'activo' => true, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
