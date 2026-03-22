<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GuiaSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('guias')->insert([
            [
                'dni' => '41234567',
                'nombre' => 'Miguel Ángel Condori Puma',
                'celular' => '984567123',
                'contacto_emergencia' => '',
                'especialidad' => 'Turismo arqueológico',
                'idiomas' => 'español, inglés, francés',
                'departamento_id' => 8, // Cusco
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'dni' => '42345678',
                'nombre' => 'Rosa María Huamán Quispe',
                'celular' => '956789012',
                'contacto_emergencia' => '',

                'idiomas' => 'quechua, francés',
                'especialidad' => 'Turismo de aventura',
                'departamento_id' => 4, // Arequipa
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'dni' => '43456789',
                'nombre' => 'Fernando Ríos Vásquez',
                'celular' => '934567890',
                'contacto_emergencia' => '',
                'especialidad' => 'Turismo ecológico',
                'idiomas' => 'español, inglés, francés',
                'departamento_id' => 17, // Madre de Dios
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'dni' => '44567890',
                'nombre' => 'Patricia Mamani Ccopa',
                'celular' => '967890123',
                'contacto_emergencia' => '',
                'idiomas' => 'quechua', 
                'especialidad' => 'Turismo cultural',
                'departamento_id' => 21, // Puno
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
