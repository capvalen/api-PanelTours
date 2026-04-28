<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VehiculoSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('vehiculos')->insert([
            [
                'tipo_vehiculo' => 'Ningún Vehículo',
                'placa' => '',
                'dni_conductor' => '',
                'nombre_conductor' => '',
                'licencia_conductor' => '',
                'edad_conductor' => 0,
                'tipo_combustible' => 'gasolina',
                'incluye_seguro' => false,
                'seguro' => '',
                'incluye_gps' => false,
                'incluye_silla_bebe' => false,
                'acepta_mascotas' => false,
                'archivos' => null,
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'tipo_vehiculo' => 'SUV',
                'placa' => 'DEF-456',
                'dni_conductor' => '52345678',
                'nombre_conductor' => 'Pedro Sánchez Ruiz',
                'licencia_conductor' => 'A-IIb-52345678',
                'edad_conductor' => 45,
                'tipo_combustible' => 'diesel',
                'incluye_seguro' => true,
                'seguro' => 'Pacífico Seguros - Auto Total',
                'incluye_gps' => true,
                'incluye_silla_bebe' => true,
                'acepta_mascotas' => true,
                'archivos' => null,
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'tipo_vehiculo' => 'Bus turístico',
                'placa' => 'GHI-789',
                'dni_conductor' => '53456789',
                'nombre_conductor' => 'Marcos Loza Fernández',
                'licencia_conductor' => 'A-IIIc-53456789',
                'edad_conductor' => 52,
                'tipo_combustible' => 'diesel',
                'incluye_seguro' => true,
                'seguro' => 'La Positiva - Transporte Turístico',
                'incluye_gps' => true,
                'incluye_silla_bebe' => false,
                'acepta_mascotas' => false,
                'archivos' => null,
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
