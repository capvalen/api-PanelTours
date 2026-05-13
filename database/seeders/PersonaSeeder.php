<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PersonaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('personas')->insert([
            [
                'venta_id' => 1,
                'es_titular' => true,
                'dni' => '12345678',
                'nombre' => 'Juan Perez',
                'fecha_nacimiento' => '1990-05-15',
                'parentesco' => 'padre',
                'enfermedades' => 'no',
                'detalle_enfermedades' => null,
                'pasaporte' => 'ABC123456',
                'fecha_caducidad_pasaporte' => '2030-05-15',
                'pais_emision' => 'Perú',
                'vacunas' => 'si',
                'detalle_vacunas' => 'Fiebre Amarilla',
                'observaciones' => 'Ninguna',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'venta_id' => 1,
                'es_titular' => false,
                'dni' => '87654321',
                'nombre' => 'Maria Lopez',
                'fecha_nacimiento' => '1992-08-20',
                'parentesco' => 'esposo/a',
                'enfermedades' => 'si',
                'detalle_enfermedades' => 'Asma leve',
                'pasaporte' => 'XYZ654321',
                'fecha_caducidad_pasaporte' => '2029-08-20',
                'pais_emision' => 'Perú',
                'vacunas' => 'si',
                'detalle_vacunas' => 'Covid-19 completa',
                'observaciones' => 'Requiere inhalador',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
