<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RestauranteSeeder extends Seeder
{
    public function run(): void
    {
        $restaurantes = [
         [
            'nombre' => 'La Huerta Feliz',
            'direccion' => 'Av. Principal 123, Miraflores',
            'contacto' => 'Juan Pérez',
            'celular' => '987654321',
            'departameto_id' => 8
        ],
        [
            'nombre' => 'Sabor Peruano',
            'direccion' => 'Calle Los Olivos 456, San Isidro',
            'contacto' => 'María García',
            'celular' => '976543210',
            'departameto_id' => 10
        ],
        [
            'nombre' => 'El Rincón Criollo',
            'direccion' => 'Jr. Amazonas 789, Cercado',
            'contacto' => 'Carlos Mendoza',
            'celular' => '965432109',
            'departameto_id' => 3
        ]
        ];
        $registros = [];
        foreach ($restaurantes as $restaurante) {
            $registros[] = [
                'departamento_id' => $restaurante ['departameto_id'],
                'direccion' => $restaurante['direccion'],
                'contacto' => $restaurante['contacto'],
                'celular' => $restaurante['celular'],
                'activo' => true,
                'created_at' => '2026-03-28 06:30:00',
                'updated_at' => '2026-03-28 06:30:00',
            ];
        }
        
        DB::table('restaurantes')->insert($registros);
    }
}
