<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VueloSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('vuelos')->insert([
            ['activo' => true, 'created_at' => now(), 'updated_at' => now()],
            ['activo' => true, 'created_at' => now(), 'updated_at' => now()],
            ['activo' => true, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
